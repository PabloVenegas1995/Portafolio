select distinct Cliente.Nombre 
from Cliente, Presupuesto 	
where Presupuesto.Precio>'60000' and Presupuesto.rutcliente= cliente.rut 