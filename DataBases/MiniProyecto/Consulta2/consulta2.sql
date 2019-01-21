select SUM(cantidad) as cantidad_total 
from pedidoaempresa
where pedidoaempresa.materialpedido='pavimento de gres' and CURRENT_DATE-fecha<30  