My spoon CRM to do:
Model name	Description	Priority
1.	Product balances 
      
Make max balance and reserved balance, list total balance for each product, put info for under optimal and warning for under minimal, make that reserved products are not listed on total sum 
2.	Oldest items	
      
Make so that it lists 3 oldest received shipments of each item	6
3.	Bill Materials	
      
Add quantities for each product recipe, make it like bill of materials so that when each product is issued for production it uses data entered here, add column for error margin in percentage	5
4.	Receipt notes	
      
Make it so that for each product balance is updated with new values
5.	Delivery notes	
      
Make it so that it counts product balances for each product issued, should accept multiple products with multiple values.
6.	Warehouse transfer	
      
Basic idea is that item can be sent from storage warehouse to processing, related to model ‘note of receipt inter process’, but this maybe can be done from new delivery note model too.
7.	Packing lists	
      
Update Product Balances whenever item is packed for shipment, that items should be reserved (reserved balance)
8.	Half products	
      
Add recipe fields for each half product, so that for 1kg of each it calculates exactly how much is going to be spent. Data is user entered
9.	Make half product	
      
Half product is still listed as product but it has no minimum and maximum balance, and is used to keep track which and from what is used to make half product. It uses products and spends it for making half product. Int_lot is generated from current date in format DDMMYYYY and it keeps track of all products int_lot-s used so that it can be backtracked. Made by should always send current user not user from list of users.
10.	Lot creates	
       
Basically it should create lot code for every day, and make users be able to enter always current int_lot across the app, so that if he received ex 03/03/2022 only int_lot available for creation is 03032022 except for module of Processing End where user enters all ingredients spent and how much of which product he made, there he can select lot in future. Date filed that will stip out shlashes and keep track of all products and half products that he used to make finished product
11.	Lot tracks	
       
Module for tracking products by it’s int_lot. It should show int_lot that is created after finished processing and show it and data related to it (time of production, time of receipt, manufacturer_lot, expiration_date
12.	Create finished product	
       
User should be able to do multiple products on that page, maybe with link click on add more items. It 
13.	Processing	
       
This should be a warehouse of its own, where he gets note of receipt from internal warehouse and keeps track of its own product and balances.
14.	Audit logs	
       
This should show user full name not id	4
15.	Processing – new note of receipt	
       
Should only give list of items from internal transfers, and pass data from it, should use issuer and received by should be auto passed with correct values. Only entrable fields should be shift, quality and date.
16.	Processing – make half-products	
       
For each product there should be 3 fields in row, product, quantity and LOT that is used for that particular product. Only available LOT codes should be ones that are already in possession of processing warehouse. After creating new half product balance is updated with new quantities and it saves new LOT code for backtracking. Maybe like HP{id}_DDMMYYYY where date is date of creation and id is ID of halfproduct (generated lot field that should be disabled). For backtracking storing this new generated LOT should save all LOTS that it consists of. 
17.	Processing – bills of processing	
       
Here user should be able to create bill of materials for all finished products. So choose from the list how much should of an ingredients will be used for production of finished product.
18.	Processing – create finished products	
       
User field should be passed automatically. Field enter manually for bill of processing should be visible under bill of processing field if no processing bill is chosen, but one must be entered.

Idea here for app is to be able to backtrack each finished product back all the way to all its ingredients and see their details from the lot tracing menu.
