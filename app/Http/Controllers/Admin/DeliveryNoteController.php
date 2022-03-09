<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDeliveryNoteRequest;
use App\Http\Requests\StoreDeliveryNoteRequest;
use App\Http\Requests\UpdateDeliveryNoteRequest;
use App\Models\CrmCustomer;
use App\Models\DeliveryNote;
use App\Models\ProductsList;
use App\Models\ReceiptNote;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DeliveryNoteController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('delivery_note_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DeliveryNote::with(['client', 'product', 'int_lot', 'issuer', 'team'])->select(sprintf('%s.*', (new DeliveryNote())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'delivery_note_show';
                $editGate = 'delivery_note_edit';
                $deleteGate = 'delivery_note_delete';
                $crudRoutePart = 'delivery-notes';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('client_company_name', function ($row) {
                return $row->client ? $row->client->company_name : '';
            });

            $table->editColumn('client.email', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->email) : '';
            });
            $table->editColumn('client.phone', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->phone) : '';
            });
            $table->editColumn('client.address', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->address) : '';
            });
            $table->editColumn('client.tax_no', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->tax_no) : '';
            });
            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->addColumn('int_lot_int_lot', function ($row) {
                return $row->int_lot ? $row->int_lot->int_lot : '';
            });

            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });
            $table->addColumn('issuer_name', function ($row) {
                return $row->issuer ? $row->issuer->name : '';
            });

            $table->editColumn('document', function ($row) {
                if (!$row->document) {
                    return '';
                }
                $links = [];
                foreach ($row->document as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'client', 'product', 'int_lot', 'issuer', 'document']);

            return $table->make(true);
        }

        $crm_customers  = CrmCustomer::get();
        $products_lists = ProductsList::get();
        $receipt_notes  = ReceiptNote::get();
        $users          = User::get();
        $teams          = Team::get();

        return view('admin.deliveryNotes.index', compact('crm_customers', 'products_lists', 'receipt_notes', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('delivery_note_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = CrmCustomer::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = ProductsList::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $int_lots = ReceiptNote::pluck('int_lot', 'id')->prepend(trans('global.pleaseSelect'), '');

        $issuers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.deliveryNotes.create', compact('clients', 'int_lots', 'issuers', 'products'));
    }

    public function store(StoreDeliveryNoteRequest $request)
    {
        $deliveryNote = DeliveryNote::create($request->all());

        foreach ($request->input('document', []) as $file) {
            $deliveryNote->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('document');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $deliveryNote->id]);
        }

        return redirect()->route('admin.delivery-notes.index');
    }

    public function edit(DeliveryNote $deliveryNote)
    {
        abort_if(Gate::denies('delivery_note_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = CrmCustomer::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = ProductsList::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $int_lots = ReceiptNote::pluck('int_lot', 'id')->prepend(trans('global.pleaseSelect'), '');

        $issuers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $deliveryNote->load('client', 'product', 'int_lot', 'issuer', 'team');

        return view('admin.deliveryNotes.edit', compact('clients', 'deliveryNote', 'int_lots', 'issuers', 'products'));
    }

    public function update(UpdateDeliveryNoteRequest $request, DeliveryNote $deliveryNote)
    {
        $deliveryNote->update($request->all());

        if (count($deliveryNote->document) > 0) {
            foreach ($deliveryNote->document as $media) {
                if (!in_array($media->file_name, $request->input('document', []))) {
                    $media->delete();
                }
            }
        }
        $media = $deliveryNote->document->pluck('file_name')->toArray();
        foreach ($request->input('document', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $deliveryNote->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('document');
            }
        }

        return redirect()->route('admin.delivery-notes.index');
    }

    public function show(DeliveryNote $deliveryNote)
    {
        abort_if(Gate::denies('delivery_note_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deliveryNote->load('client', 'product', 'int_lot', 'issuer', 'team');

        return view('admin.deliveryNotes.show', compact('deliveryNote'));
    }

    public function destroy(DeliveryNote $deliveryNote)
    {
        abort_if(Gate::denies('delivery_note_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deliveryNote->delete();

        return back();
    }

    public function massDestroy(MassDestroyDeliveryNoteRequest $request)
    {
        DeliveryNote::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('delivery_note_create') && Gate::denies('delivery_note_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new DeliveryNote();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
