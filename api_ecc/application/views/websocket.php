

<script src='<?php echo $this->mainconfig->webconfig('websocket') ?>/socket.io/socket.io.js'></script>
<script src="https://code.jquery.com/jquery-1.11.1.js"></script>

<script type="text/javascript">
	var socket = io('<?php echo $this->mainconfig->webconfig('websocket') ?>',{transports: ['websocket'], upgrade: false});
	
	socket.on('connect', function () {});
	
	<?php
		if($market){
			foreach($market as $dt_market){
	?>			
				socket.emit('updatedata',{"channel":"marketdata_chart","market_id":"<?php echo $dt_market['market_id'] ?>"});
	<?php
			}
		}			
	?>
</script>
