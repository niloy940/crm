CRM Requirements (basic idea and usage)

roles/permissions, clients, notifications ,warehouses, logs, bill of materials

1.	Roles/Permissions and user use-case

-ADMIN
      

●	admin should be only one able to register new users

●	has access to all functionalities (even ones that i will describe i dont wanna DRY)

●	configures permissions/roles for all other roles

●	every change on the users table should be logged by whom it’s made and when (not exact thing that is done)



-MANAGER

●	give tasks for regular users something like notifications or even messaging

●	crud for clients, warehouses (there is 2 types of warehouses - storage and processing)

●	assign or unassign warehouse for the user

●	read all the data and print it out

●	log every change to the cruds

●   create bill of materials for each needed product, manage quantities needed, and create work orders with quantities of finished product that should be calculated by application and submitted to the other choosen users


-USER

●	reads tasks or messages assigned to him

●	has access to 1 or multiple warehouses

●	transfer quantities between warehouses and upon sending other user that’s in charge of that specific warehouse should confirm it , and only then balance of warehouses is updated. Upon confirming that creates a document that is then saved and printable, with the data about lot codes, quantities, and users. Upon transfering from the warehouse 1 to warehouse 2 new lot code should be generated like the extension of the previous.

●	In case of processing warehouse type, user should have crud for entering spent amounts and then updating finished products with added balance and new LOT code that is in some time in advance (date field, that is gonna mark for example 9 months from now, but he should be able to have input for it, and it should be saved in a format like ‘16022022’);

●	In case of warehouse type storage, user should be able to receive items and give out items (receipt notes and delivery notes) for which he enters data (client, items, warehouse, LOT, document, datetime)

●   See work orders and update info about them

Explanations about LOT codes:

This should be a pivot table that tracks down items from finished products all the way back to the every ingridient used. At the end of a working shift, when user that is working in processing warehouse enters finished product, all the data for it should be saved. Admin should be able to search through this table by choosing type of search (ingridients or finished product) and entering lot code, that will then display all related data
