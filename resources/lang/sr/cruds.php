<?php

return [
    'userManagement' => [
        'title'          => 'Upravljanje korisnicima',
        'title_singular' => 'Upravljanje korisnicima',
    ],
    'permission' => [
        'title'          => 'Dozvole',
        'title_singular' => 'Dozvola',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Naziv',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Uloge',
        'title_singular' => 'Uloga',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Korisnici',
        'title_singular' => 'Korisnik',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Ime',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email potvrdjen u',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Lozinka',
            'password_helper'          => ' ',
            'roles'                    => 'Uloga',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'team'                     => 'Team',
            'team_helper'              => ' ',
        ],
    ],
    'basicCRM' => [
        'title'          => 'Klijenti',
        'title_singular' => 'Klijenti',
    ],
    'crmStatus' => [
        'title'          => 'Statusi',
        'title_singular' => 'Statusi',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Naziv',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
            'team'              => 'Tim',
            'team_helper'       => ' ',
        ],
    ],
    'crmCustomer' => [
        'title'          => 'Klijenti',
        'title_singular' => 'Klijenti',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'first_name'          => 'Ime',
            'first_name_helper'   => ' ',
            'last_name'           => 'Prezime',
            'last_name_helper'    => ' ',
            'status'              => 'Tip',
            'status_helper'       => ' ',
            'email'               => 'Email',
            'email_helper'        => ' ',
            'phone'               => 'Telefon',
            'phone_helper'        => ' ',
            'address'             => 'Adresa',
            'address_helper'      => ' ',
            'description'         => 'Opis',
            'description_helper'  => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated At',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted At',
            'deleted_at_helper'   => ' ',
            'company_name'        => 'Ime kompanije',
            'company_name_helper' => ' ',
            'tax_no'              => 'PIB',
            'tax_no_helper'       => ' ',
            'team'                => 'Tim',
            'team_helper'         => ' ',
        ],
    ],
    'crmNote' => [
        'title'          => 'Beleske',
        'title_singular' => 'Beleske',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'customer'          => 'Klijent',
            'customer_helper'   => ' ',
            'note'              => 'Beleska',
            'note_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
            'team'              => 'Tim',
            'team_helper'       => ' ',
        ],
    ],
    'crmDocument' => [
        'title'          => 'Dokumenta',
        'title_singular' => 'Dokumentum',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'customer'             => 'Klijent',
            'customer_helper'      => ' ',
            'document_file'        => 'File',
            'document_file_helper' => ' ',
            'name'                 => 'Naziv dokumenta',
            'name_helper'          => ' ',
            'description'          => 'Opis',
            'description_helper'   => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated At',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted At',
            'deleted_at_helper'    => ' ',
            'type'                 => 'Tip',
            'type_helper'          => ' ',
            'team'                 => 'Tim',
            'team_helper'          => ' ',
        ],
    ],
    'auditLog' => [
        'title'          => 'Logovi',
        'title_singular' => 'Logovi',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'userAlert' => [
        'title'          => 'Notifikacije',
        'title_singular' => 'Notifikacije',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'Tekst obavestenja',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Link obavestenja',
            'alert_link_helper' => ' ',
            'user'              => 'Korisnici',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],
    'taskManagement' => [
        'title'          => 'Upravljanje zadacima',
        'title_singular' => 'Upravljanje zadacima',
    ],
    'taskStatus' => [
        'title'          => 'Statusi',
        'title_singular' => 'Statusi',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Naziv',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'taskTag' => [
        'title'          => 'Tagovi',
        'title_singular' => 'Tagovi',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Naziv',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'task' => [
        'title'          => 'Zadatci',
        'title_singular' => 'Zadatci',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Naziv',
            'name_helper'        => ' ',
            'description'        => 'Opis',
            'description_helper' => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'tag'                => 'Tagovi',
            'tag_helper'         => ' ',
            'attachment'         => 'Prilozi',
            'attachment_helper'  => ' ',
            'due_date'           => 'Do datuma',
            'due_date_helper'    => ' ',
            'assigned_to'        => 'Dodeljeno za',
            'assigned_to_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'tasksCalendar' => [
        'title'          => 'Kalendar',
        'title_singular' => 'Kalendar',
    ],
    'team' => [
        'title'          => 'Timovi',
        'title_singular' => 'Timovi',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
            'name'              => 'Naziv',
            'name_helper'       => ' ',
        ],
    ],
    'assetManagement' => [
        'title'          => 'Upravljanje alatima',
        'title_singular' => 'Upravljanje alatima',
    ],
    'assetCategory' => [
        'title'          => 'Kategorije',
        'title_singular' => 'Kategorije',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Naziv',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
            'team'              => 'Tim',
            'team_helper'       => ' ',
        ],
    ],
    'assetLocation' => [
        'title'          => 'Lokacije',
        'title_singular' => 'Lokacije',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Naziv',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
            'team'              => 'im',
            'team_helper'       => ' ',
        ],
    ],
    'assetStatus' => [
        'title'          => 'Statusi',
        'title_singular' => 'Statusi',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Naziv',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
            'team'              => 'Tim',
            'team_helper'       => ' ',
        ],
    ],
    'asset' => [
        'title'          => 'Alati',
        'title_singular' => 'Alati',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'category'             => 'Kategorija',
            'category_helper'      => ' ',
            'serial_number'        => 'Serijski broj',
            'serial_number_helper' => ' ',
            'name'                 => 'Naziv',
            'name_helper'          => ' ',
            'photos'               => 'Slika',
            'photos_helper'        => ' ',
            'status'               => 'Status',
            'status_helper'        => ' ',
            'location'             => 'Lokacija',
            'location_helper'      => ' ',
            'notes'                => 'Beleska',
            'notes_helper'         => ' ',
            'assigned_to'          => 'Dodeljeno',
            'assigned_to_helper'   => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated At',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted At',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'assetsHistory' => [
        'title'          => 'Istorija koriscenja alata',
        'title_singular' => 'Istorija koriscenja alatum',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'asset'                => 'Alat',
            'asset_helper'         => ' ',
            'status'               => 'Status',
            'status_helper'        => ' ',
            'location'             => 'Lokacija',
            'location_helper'      => ' ',
            'assigned_user'        => 'Dodeljeno korisniku',
            'assigned_user_helper' => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated At',
            'updated_at_helper'    => ' ',
            'team'                 => 'Tim',
            'team_helper'          => ' ',
        ],
    ],
    'timeManagement' => [
        'title'          => 'Upravljanje vremenima',
        'title_singular' => 'Upravljanje vremenima',
    ],
    'timeWorkType' => [
        'title'          => 'Tipovi rada',
        'title_singular' => 'Tip rada',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Naziv',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
            'team'              => 'Tim',
            'team_helper'       => ' ',
        ],
    ],
    'timeProject' => [
        'title'          => 'Projekti',
        'title_singular' => 'Projekat',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Naziv',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
            'team'              => 'Tim',
            'team_helper'       => ' ',
        ],
    ],
    'timeEntry' => [
        'title'          => 'Unosi vremena',
        'title_singular' => 'Unos vremena',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'work_type'         => 'Tip rada',
            'work_type_helper'  => ' ',
            'project'           => 'Prokat',
            'project_helper'    => ' ',
            'start_time'        => 'Vreme pocetka',
            'start_time_helper' => ' ',
            'end_time'          => 'Vreme zavrsetka',
            'end_time_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
            'team'              => 'Tim',
            'team_helper'       => ' ',
        ],
    ],
    'timeReport' => [
        'title'          => 'Mesecni izvestaj',
        'title_singular' => 'Mesecni izvestaj',
        'reports'        => [
            'title'             => 'Izvestaji',
            'title_singular'    => 'Izvestaj',
            'timeEntriesReport' => 'Izvestaji vremenskih unosa',
            'timeByProjects'    => 'Izvestaji po projektu',
            'timeByWorkType'    => 'Izvestaju po tipu rada',
        ],
    ],
    'faqManagement' => [
        'title'          => 'Upravljanje objasnjenjima',
        'title_singular' => 'Upravljanje objasnjenjima',
    ],
    'faqCategory' => [
        'title'          => 'Kategorije',
        'title_singular' => 'Kategorije',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Kategorija',
            'category_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'faqQuestion' => [
        'title'          => 'Pitanja',
        'title_singular' => 'Pitanja',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Kategorija',
            'category_helper'   => ' ',
            'question'          => 'Pitanje',
            'question_helper'   => ' ',
            'answer'            => 'Odgovor',
            'answer_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'warehouse' => [
        'title'          => 'Magacini',
        'title_singular' => 'Magacini',
    ],
    'product' => [
        'title'          => 'Proizvodi',
        'title_singular' => 'Proizvodi',
    ],
    'productsList' => [
        'title'          => 'Lista proizvoda',
        'title_singular' => 'Lista proizvoda',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'name'                   => 'Naziv',
            'name_helper'            => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'team'                   => 'Team',
            'team_helper'            => ' ',
            'warehouse'              => 'Magacin proizvoda',
            'warehouse_helper'       => 'Magacin kome prozvod pripada.',
            'price'                  => 'Cena',
            'price_helper'           => ' ',
            'measure'                => 'Merna jedinica',
            'measure_helper'         => ' ',
            'int_lot'                => 'Interni LOT',
            'int_lot_helper'         => ' ',
            'balance_optimal'        => 'Optimalno stanje',
            'balance_optimal_helper' => ' ',
            'balance_min'            => 'Minimalno stanje',
            'balance_min_helper'     => ' ',
        ],
    ],
    'warehousesList' => [
        'title'          => 'Lista Magacina',
        'title_singular' => 'Lista Magacina',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Naziv',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'team'              => 'Team',
            'team_helper'       => ' ',
        ],
    ],
    'receiptNote' => [
        'title'          => 'Nova prijemnica',
        'title_singular' => 'Nova prijemnica',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'product'             => 'Naziv',
            'product_helper'      => ' ',
            'quantity'            => 'Kolicina',
            'quantity_helper'     => ' ',
            'lot'                 => 'Lot',
            'lot_helper'          => 'Lot proizvodjaca',
            'int_lot'             => 'Interni Lot',
            'int_lot_helper'      => 'Interni LOT (SI_datum ili GP_datum - SI je sirovina GP je gotov proizvod, PR proizvodnja)',
            'warehouse'           => 'Magacin',
            'warehouse_helper'    => 'Magacin u koji proizvod ide',
            'qc'                  => 'Ispravnost',
            'qc_helper'           => 'Ispravnost proizvoda',
            'shift'               => 'Smena',
            'shift_helper'        => 'Smena u kojoj je primljena roba',
            'date'                => 'Datum',
            'date_helper'         => 'Datum prijema',
            'place'               => 'Mesto',
            'place_helper'        => ' ',
            'driver'              => 'Vozač',
            'driver_helper'       => 'Ime i prezime vozača',
            'id_driver'           => 'Broj dokumenta vozača',
            'id_driver_helper'    => 'Broj lične karte ili pasoša vozača',
            'registration'        => 'Registracija',
            'registration_helper' => 'Registracija vozila koje je donelo robu',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'client'              => 'Dobavljač',
            'client_helper'       => 'Naziv dobavljača. Ukoliko nema u listi dobavljač nije unet u listu.',
            'team'                => 'Team',
            'team_helper'         => ' ',
            'print'               => 'Štampaj',
            'print_helper'        => ' ',
            'expiry_date'         => 'Rok trajanja',
            'expiry_date_helper'  => 'Uneti rok trajanja za proizvod ako ga ima',
            'conditions'          => 'Uslovi čuvanja',
            'conditions_helper'   => ' ',
        ],
    ],
    'deliveryNote' => [
        'title'          => 'Nova Otpremnica',
        'title_singular' => 'Nova Otpremnica',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'client'            => 'Klijent',
            'client_helper'     => ' ',
            'product'           => 'Proizvod',
            'product_helper'    => ' ',
            'quantity'          => 'Količina',
            'quantity_helper'   => ' ',
            'issuer'            => 'Izdao',
            'issuer_helper'     => ' ',
            'document'          => 'Dokument',
            'document_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'team'              => 'Team',
            'team_helper'       => ' ',
        ],
    ],
    'warehouseTransfer' => [
        'title'          => 'Prenos stanja',
        'title_singular' => 'Prenos stanja',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'warehouse_from'        => 'Iz magacina',
            'warehouse_from_helper' => 'Magacin iz koga se izdaje',
            'warehouse_to'          => 'U magacin',
            'warehouse_to_helper'   => 'Magacin kome se izdaje',
            'product'               => 'Proizvod',
            'product_helper'        => ' ',
            'quantity'              => 'Količina',
            'quantity_helper'       => ' ',
            'user'                  => 'Izdao',
            'user_helper'           => ' ',
            'user_received'         => 'Preuzeo',
            'user_received_helper'  => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'team'                  => 'Team',
            'team_helper'           => ' ',
        ],
    ],
    'packingList' => [
        'title'          => 'Nova paking lista',
        'title_singular' => 'Nova paking listum',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'client'              => 'Klijent',
            'client_helper'       => ' ',
            'product'             => 'Naziv proizvoda',
            'product_helper'      => ' ',
            'quantity'            => 'Kolicina',
            'quantity_helper'     => ' ',
            'net_weight'          => 'Težina neto',
            'net_weight_helper'   => ' ',
            'bruto_weight'        => 'Težina bruto',
            'bruto_weight_helper' => ' ',
            'width'               => 'Širina',
            'width_helper'        => ' ',
            'height'              => 'Visina',
            'height_helper'       => ' ',
            'length'              => 'Dužina',
            'length_helper'       => ' ',
            'user'                => 'Izdao',
            'user_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'team'                => 'Team',
            'team_helper'         => ' ',
        ],
    ],
    'pdfInvoice' => [
        'title'          => 'Kreiraj dokument',
        'title_singular' => 'Kreiraj dokument',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'customer'          => 'Klijent',
            'customer_helper'   => ' ',
            'products'          => 'Proizvodi',
            'products_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'team'              => 'Team',
            'team_helper'       => ' ',
            'type'              => 'Tip',
            'type_helper'       => ' ',
            'status'            => 'Status placanja',
            'status_helper'     => ' ',
            'discount'          => 'Rabat',
            'discount_helper'   => ' ',
            'pay_until'         => 'Datum placanja',
            'pay_until_helper'  => 'Unesite broj dana za koje bi trebalo da se izvrsi placanje',
            'note'              => 'Beleska',
            'note_helper'       => 'Beleska se ispisuje ispod dokumenta ukoliko postoji',
        ],
    ],
    'lotTracking' => [
        'title'          => 'Upravljanje Lotovima',
        'title_singular' => 'Upravljanje Lotovima',
    ],
    'processing' => [
        'title'          => 'Proizvodnja',
        'title_singular' => 'Proizvodnja',
    ],
    'noteOfRecepitInterProcess' => [
        'title'          => 'Nova prijemnica',
        'title_singular' => 'Nova prijemnica',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'product'            => 'Proizvod',
            'product_helper'     => ' ',
            'quantity'           => 'Kolicina',
            'quantity_helper'    => ' ',
            'warehouse'          => 'Magacin',
            'warehouse_helper'   => 'Magacin u koji proizvod ide',
            'qc'                 => 'Ispravnost',
            'qc_helper'          => 'Ispravnost proizvoda',
            'conditions'         => 'Uslovi čuvanja',
            'conditions_helper'  => ' ',
            'shift'              => 'Smena',
            'shift_helper'       => 'Smena u kojoj je primljena roba',
            'date'               => 'Datum',
            'date_helper'        => 'Datum prijema',
            'issuer'             => 'Izdao',
            'issuer_helper'      => 'Ime i prezime vozača',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'print'              => 'Štampaj',
            'print_helper'       => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'team'               => 'Team',
            'team_helper'        => ' ',
            'received_by'        => 'Primio',
            'received_by_helper' => ' ',
            'int_lot'            => 'Interni LOT',
            'int_lot_helper'     => ' ',
        ],
    ],
    'halfProduct' => [
        'title'          => 'Lista poluproizvoda',
        'title_singular' => 'Lista poluproizvoda',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'team'              => 'Team',
            'team_helper'       => ' ',
            'name'              => 'Naziv',
            'name_helper'       => 'Naziv za novi poluproizvod',
        ],
    ],
    'oldestItem' => [
        'title'          => 'Rokovi pred istek',
        'title_singular' => 'Rokovi pred istek',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'product'            => 'Proizvod',
            'product_helper'     => ' ',
            'expiry_date'        => 'Rok trajanja',
            'expiry_date_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'team'               => 'Team',
            'team_helper'        => ' ',
            'quantity'           => 'Količina',
            'quantity_helper'    => ' ',
            'int_lot'            => 'Interni LOT',
            'int_lot_helper'     => ' ',
        ],
    ],
    'productBalance' => [
        'title'          => 'Stanje proizvoda',
        'title_singular' => 'Stanje proizvoda',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'name'                   => 'Proizvod',
            'name_helper'            => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'team'                   => 'Team',
            'team_helper'            => ' ',
            'quantity'               => 'Količina',
            'quantity_helper'        => ' ',
            'balance_optimal'        => 'Optimalno stanje',
            'balance_optimal_helper' => ' ',
            'balance_min'            => 'Minimalno stanje',
            'balance_min_helper'     => ' ',
        ],
    ],
    'billMaterial' => [
        'title'          => 'Troškovi materijala',
        'title_singular' => 'Troškovi materijala',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'for_product'        => 'Za proizvod',
            'for_product_helper' => ' ',
            'ingridients'        => 'Sastavni proizvodi',
            'ingridients_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'team'               => 'Team',
            'team_helper'        => ' ',
        ],
    ],
    'halfProductMake' => [
        'title'          => 'Napravi poluproizvod',
        'title_singular' => 'Napravi poluproizvod',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'halfproduct'        => 'Poluproizvod',
            'halfproduct_helper' => ' ',
            'ingridients'        => 'Sastojci',
            'ingridients_helper' => ' ',
            'quantity'           => 'Količina',
            'quantity_helper'    => 'Koliko je proizvoda napravljeno',
            'made_by'            => 'Napravio',
            'made_by_helper'     => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'int_lot'            => 'Interni LOT',
            'int_lot_helper'     => ' ',
        ],
    ],
    'lotCreate' => [
        'title'          => 'Lista LOTova',
        'title_singular' => 'Lista LOTova',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'int_lot'           => 'Interni LOT',
            'int_lot_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'team'              => 'Team',
            'team_helper'       => ' ',
        ],
    ],
    'lotTrack' => [
        'title'          => 'Praćenje LOTova',
        'title_singular' => 'Praćenje LOTova',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'int_lot'           => 'Interni LOT',
            'int_lot_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'team'              => 'Team',
            'team_helper'       => ' ',
        ],
    ],
];
