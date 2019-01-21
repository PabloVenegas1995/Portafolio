INSERT INTO "proveedor" (RUT,nombre,telefono,direccion) VALUES 
('9.999.999-9','Tony Stark','111111','Winterfell'),
('8.888.888-8','Ned Stark','2222222','Winterfell'),
('7.777.777-7','Bran Stark','3333333','Winterfell'),
('6.666.666-6','Sansa Stark','4444444','Winterfell'),
('5.555.555-5','Arya Stark','5555555','Winterfell');

INSERT INTO "pedidoaproveedor" (CodigoPedido,Cantidad,MaterialSolicitado,precio,fecha) VALUES
('1','12','hormigon armado','500','2000/01/12'),
('2','10','hormigon armado','500','1999/12/25'),
('3','5','acero externo','500','1999/12/25'),
('4','20','acero externo','500','2000/01/12'),
('5','10','hormigon armado','500','1999/12/25'),
('6','10','hormigon armado','500','2000/01/12'),
('7','15','hormigon armado','500','1999/12/25');

INSERT INTO "material" (CodigoMaterial,Nombre,Descripcion,Zona,Nicho) VALUES 
('001','hormigon armado','hormigon que viene armado de fabrica','A','1'),
('002','acero externo','acero que viene del exterior','B','2');

INSERT INTO "realizadamediante" (RUTProveedor,CodigoMaterial,Codigo_Pedido) VALUES
('9.999.999-9','001','1'),
('9.999.999-9','001','2'),
('8.888.888-8','002','3'),
('8.888.888-8','002','4'),
('7.777.777-7','001','5'),
('6.666.666-6','001','6'),
('5.555.555-5','001','7');
