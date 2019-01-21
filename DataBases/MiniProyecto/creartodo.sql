DROP TABLE Material CASCADE;
DROP TABLE Proveedor CASCADE;
DROP TABLE PedidoAProveedor CASCADE;
DROP TABLE Cliente CASCADE;
DROP TABLE Telefonos CASCADE;
DROP TABLE Presupuesto CASCADE;
DROP TABLE PedidoAEmpresa CASCADE;
DROP TABLE Albaran CASCADE;
DROP TABLE RealizadaMediante CASCADE;

CREATE TABLE Material
(CodigoMaterial varchar(50), 
Nombre varchar(50), 
Descripcion varchar(50), 
Zona varchar(50), 
Nicho varchar(50),
primary key (CodigoMaterial));

CREATE TABLE Proveedor
(RUT varchar(50),
Nombre varchar(50),
Telefono varchar(50),
Direccion varchar(50),
primary key (RUT));

CREATE TABLE PedidoAProveedor
(CodigoPedido varchar(50),
Cantidad int,
MaterialSolicitado varchar(50),
Precio varchar(50),
Fecha date,
primary key (CodigoPedido));

CREATE TABLE Cliente
(RUT varchar(50),
Nombre varchar(50),
Direccion varchar(50),
CodigoPostal varchar(50),
primary key (RUT));

CREATE TABLE Telefonos
(RUTCliente varchar(50),
Telefono varchar(50),
foreign key (RUTCliente) references Cliente(RUT));

CREATE TABLE Presupuesto
(RUTCliente varchar(50),
MaterialSolicitado varchar(50),
Precio varchar(50),
Cantidad int,
foreign key (RUTCliente) references Cliente(RUT));

CREATE TABLE PedidoAEmpresa(RUTCliente varchar(50),
Fecha date,
NumeroPedido varchar(50),
Cantidad int,
MaterialPedido varchar(50),
foreign key (RUTCliente) references Cliente(RUT));

CREATE TABLE Albaran
(IDAlbaran varchar(50),
Precio varchar(50),
Cantidad int,
MaterialesPresentes varchar(50),
primary key (IDAlbaran));

CREATE TABLE RealizadaMediante
(RUTProveedor varchar(50),
CodigoMaterial varchar(50),
Codigo_Pedido varchar(50), 
foreign key (RUTProveedor) references Proveedor(RUT),
foreign key (CodigoMaterial) references Material(CodigoMaterial),
foreign key (Codigo_Pedido) references PedidoAProveedor(CodigoPedido));

INSERT INTO "cliente" (RUT,Nombre,Direccion,CodigoPostal) VALUES 
('11.111.111-1','Danny Rand','Hells Kitchen','1111'),
('22.222.222-2','Matt Murdock','Hells Kitchen','2222'),
('33.333.333-3','John Smith','Hells Kitchen','3333'),
('44.444.444-4','Jessica Jones','Hells Kitchen','4444'),
('55.555.555-5','Luke Cage','Hells Kitchen','5555');

INSERT INTO "presupuesto" (RUTCliente,materialsolicitado,precio,cantidad) VALUES 
('11.111.111-1','acero','50000','10'),
('11.111.111-1','madera','80000','10'),
('11.111.111-1','pavimento','70000','10'),
('11.111.111-1','metal','40000','10'),
('33.333.333-3','madera','10000','1'),
('33.333.333-3','madera','50000','5'),
('33.333.333-3','madera','61000','6'),
('33.333.333-3','madera','70000','7'),
('44.444.444-4','acero','50000','1'),
('55.555.555-5','madera','50000','1');

INSERT INTO "pedidoaempresa" (RUTCliente,fecha,NumeroPedido,cantidad,MaterialPedido) VALUES 
('11.111.111-1','2016/08/01','1','10','pavimento de gres'),
('11.111.111-1','2016/10/20','2','10','pavimento de gres'),
('44.444.444-4','2016/10/20','1','10','pavimento de gres'),
('44.444.444-4','2016/10/20','2','10','acero'),
('55.555.555-5','2016/08/02','1','10','pavimento de gres');

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
