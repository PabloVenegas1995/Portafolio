SELECT proveedor.nombre
from proveedor , realizadamediante, pedidoaproveedor 
where pedidoaproveedor.materialsolicitado = 'hormigon armado'and 
pedidoaproveedor.codigopedido = realizadamediante.codigo_pedido and 
realizadamediante.rutproveedor = proveedor.rut  and pedidoaproveedor.fecha > '2000-01-01' 