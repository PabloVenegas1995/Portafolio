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
Cantidad varchar(50),
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
(IDPresupuesto varchar(50),
RUTCliente varchar(50),
MaterialSolicitado varchar(50),
Precio varchar(50),
Cantidad varchar(50),
primary key (IDPresupuesto),
foreign key (RUTCliente) references Cliente(RUT));

CREATE TABLE PedidoAEmpresa(RUTCliente varchar(50),
Fecha date,
NumeroPedido varchar(50),
Cantidad varchar(50),
MaterialPedido varchar(50),
IDPedidoEmpresa varchar(50),
primary key (IDPedidoEmpresa),
foreign key (RUTCliente) references Cliente(RUT));

CREATE TABLE Albaran
(IDAlbaran varchar(50),
Precio varchar(50),
Cantidad varchar(50),
MaterialesPresentes varchar(50),
primary key (IDAlbaran));

CREATE TABLE RealizadaMediante
(RUTProveedor varchar(50),
CodigoMaterial varchar(50),
Codigo_Pedido varchar(50), 
foreign key (RUTProveedor) references Proveedor(RUT),
foreign key (CodigoMaterial) references Material(CodigoMaterial),
foreign key (Codigo_Pedido) references PedidoAProveedor(CodigoPedido));

