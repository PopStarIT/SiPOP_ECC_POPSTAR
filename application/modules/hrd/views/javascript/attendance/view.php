<script type="text/javascript">  
	$(function () {
        "use strict";
				
		 $("#table_<?php echo $methodid ?>_keterangan_M").jqGrid({
			url: baseurl+'<?php echo $class_uri ?>/loaddata_dashboard_M',
			mtype : "post",
			postData:{'q':'1','ket':'M','date_start':'<?php echo date("Y-m-d") ?>','date_end':'<?php echo date("Y-m-d") ?>','<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'},
			datatype: "json",
			//colNames:['ID','ID ABSEN','NAME','DEPARTEMENT', 'DIVISI', 'SUB DIVISI', 'WORKING TIME', 'YEAR','HOURS','IN','CT','SK','P2'
			//          ,'P3','SD','DS','DL','IP','TM','TP','PC','M'], 
            colNames:['ID','ID ABSEN','NAME','DEPARTEMENT', 'DIVISI', 'SUB DIVISI', 'WORKING TIME', 'YEAR','M'],	 
			colModel:[
				{name:'r1',index:'r1', width:70},
				{name:'r2',index:'r2', width:80},
				{name:'r3',index:'r3', width:250},
				{name:'r4',index:'r4', width:80,hidden: true },
				{name:'r5',index:'r5', width:70,hidden: true },  
				{name:'r6',index:'r6', width:80,hidden: true },  
				{name:'r7',index:'r7', width:200,search: false},  
				{name:'r8',index:'r8', width:50,align: 'center',search: false},
				{name:'r11',index:'r11', width:50,align: 'center',search: false},
									
			],
			iconSet: "fontAwesome",
            iconSet: "fontAwesome",
            idPrefix: "g1_",
            rownumbers: true,
			rowNum:10,
			rowList:[10,20,30],
			pager: '#ptable_<?php echo $methodid ?>_keterangan_M',
            sortname: "r1",
            sortorder: "asc",
			shrinkToFit:true,
			autowidth: true,
			height: 250,		
			jsonReader: { repeatitems : false },
			viewrecords : true,
			gridview:true
	       	           			
		});	
		
	    $("#table_<?php echo $methodid ?>_keterangan_M").jqGrid("setColProp", "rn", {hidedlg: false});
	    $("#table_<?php echo $methodid ?>_keterangan_M").jqGrid('navGrid','#ptable_<?php echo $methodid ?>_keterangan_M',{edit:false,add:false,del:false,view:false,search: false});
        $("#table_<?php echo $methodid ?>_keterangan_M").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false, defaultSearch: 'cn', ignoreCase: false});	
		
		
		    	
		 $("#table_<?php echo $methodid ?>_keterangan_S").jqGrid({
			  url: baseurl+'<?php echo $class_uri ?>/loaddata_dashboard_S',
			  mtype : "post",
			  postData:{'q':'1','ket':'S','date_start':'<?php echo date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) ) ?>','date_end':'<?php echo date("Y-m-d") ?>','<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'},
			  datatype: "json",
			 colNames:['ID','ID ABSEN','NAME','DEPARTEMENT', 'DIVISI', 'SUB DIVISI', 'WORKING TIME', 'YEAR','S'],	 
			 colModel:[
				{name:'r1',index:'r1', width:70},
				{name:'r2',index:'r2', width:80},
				{name:'r3',index:'r3', width:250},
				{name:'r4',index:'r4', width:80,hidden: true },
				{name:'r5',index:'r5', width:70,hidden: true },  
				{name:'r6',index:'r6', width:80,hidden: true },  
				{name:'r7',index:'r7', width:200,search: false},  
				{name:'r8',index:'r8', width:50,align: 'center',search: false},
				{name:'r16',index:'r16', width:50,align: 'center',search: false},
			    ],
				iconSet: "fontAwesome",
                iconSet: "fontAwesome",
                idPrefix: "g1_",
                rownumbers: true,
			    rowNum:10,
			    rowList:[10,20,30],
			    pager: '#ptable_<?php echo $methodid ?>_keterangan_S',
                sortname: "r1",
                sortorder: "asc",
			    shrinkToFit:true,
			    autowidth: true,
			    height: 250,		
			    jsonReader: { repeatitems : false },
			    viewrecords : true,
			    gridview:true
        });
		
		 $("#table_<?php echo $methodid ?>_keterangan_S").jqGrid("setColProp", "rn", {hidedlg: false});
		 $("#table_<?php echo $methodid ?>_keterangan_S").jqGrid('navGrid','#ptable_<?php echo $methodid ?>_keterangan_S',{edit:false,add:false,del:false,view:false,search: false});
         $("#table_<?php echo $methodid ?>_keterangan_S").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false, defaultSearch: 'cn', ignoreCase: false});
		
		
		
		$("#table_<?php echo $methodid ?>_keterangan_C").jqGrid({
			url: baseurl+'<?php echo $class_uri ?>/loaddata_dashboard_C',
			mtype : "post",
			postData:{'q':'1','ket':'CT','date_start':'<?php echo date("Y-m-d") ?>','date_end':'<?php echo date("Y-m-d") ?>','<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'},
			datatype: "json",
			//colNames:['ID','ID ABSEN','NAME','DEPARTEMENT', 'DIVISI', 'SUB DIVISI', 'WORKING TIME', 'YEAR','HOURS','IN','CT','SK','P2'
			//          ,'P3','SD','DS','DL','IP','TM','TP','PC','M'], 
            colNames:['ID','ID ABSEN','NAME','DEPARTEMENT', 'DIVISI', 'SUB DIVISI', 'WORKING TIME', 'YEAR','C'],	 
			colModel:[
				{name:'r1',index:'r1', width:70},
				{name:'r2',index:'r2', width:80},
				{name:'r3',index:'r3', width:250},
				{name:'r4',index:'r4', width:80,hidden: true },
				{name:'r5',index:'r5', width:70,hidden: true },  
				{name:'r6',index:'r6', width:80,hidden: true },  
				{name:'r7',index:'r7', width:200,search: false},  
				{name:'r8',index:'r8', width:50,align: 'center',search: false},
				{name:'r18',index:'r18', width:50,align: 'center',search: false},
									
			],
			iconSet: "fontAwesome",
            iconSet: "fontAwesome",
            idPrefix: "g1_",
            rownumbers: true,
			rowNum:10,
			rowList:[10,20,30],
			pager: '#ptable_<?php echo $methodid ?>_keterangan_C',
            sortname: "r1",
            sortorder: "asc",
			shrinkToFit:true,
			autowidth: true,
			height: 250,		
			jsonReader: { repeatitems : false },
			viewrecords : true,
			gridview:true
	       	           			
		});	
		
	    $("#table_<?php echo $methodid ?>_keterangan_C").jqGrid("setColProp", "rn", {hidedlg: false});
		$("#table_<?php echo $methodid ?>_keterangan_C").jqGrid('navGrid','#ptable_<?php echo $methodid ?>_keterangan_C',{edit:false,add:false,del:false,view:false,search: false});
      	$("#table_<?php echo $methodid ?>_keterangan_C").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false, defaultSearch: 'cn', ignoreCase: false});	
		
		
		$("#table_<?php echo $methodid ?>_keterangan_P3").jqGrid({
			url: baseurl+'<?php echo $class_uri ?>/loaddata_dashboard_P3',
			mtype : "post",
			postData:{'q':'1','ket':'P3','date_start':'<?php echo date("Y-m-d") ?>','date_end':'<?php echo date("Y-m-d") ?>','<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'},
			datatype: "json",
			//colNames:['ID','ID ABSEN','NAME','DEPARTEMENT', 'DIVISI', 'SUB DIVISI', 'WORKING TIME', 'YEAR','HOURS','IN','CT','SK','P2'
			//          ,'P3','SD','DS','DL','IP','TM','TP','PC','M'], 
            colNames:['ID','ID ABSEN','NAME','DEPARTEMENT', 'DIVISI', 'SUB DIVISI', 'WORKING TIME', 'YEAR','CL'],	 
			colModel:[
				{name:'r1',index:'r1', width:70},
				{name:'r2',index:'r2', width:80},
				{name:'r3',index:'r3', width:250},
				{name:'r4',index:'r4', width:80,hidden: true },
				{name:'r5',index:'r5', width:70,hidden: true },  
				{name:'r6',index:'r6', width:80,hidden: true },  
				{name:'r7',index:'r7', width:200,search: false},  
				{name:'r8',index:'r8', width:50,align: 'center',search: false},
				{name:'r13',index:'r13', width:50,align: 'center',search: false},
									
			],
			iconSet: "fontAwesome",
            iconSet: "fontAwesome",
            idPrefix: "g1_",
            rownumbers: true,
			rowNum:10,
			rowList:[10,20,30],
			pager: '#ptable_<?php echo $methodid ?>_keterangan_P3',
            sortname: "r1",
            sortorder: "asc",
			shrinkToFit:true,
			autowidth: true,
			height: 250,		
			jsonReader: { repeatitems : false },
			viewrecords : true,
			gridview:true
	       	           			
		});	
		
	    $("#table_<?php echo $methodid ?>_keterangan_P3").jqGrid("setColProp", "rn", {hidedlg: false});
		$("#table_<?php echo $methodid ?>_keterangan_P3").jqGrid('navGrid','#ptable_<?php echo $methodid ?>_keterangan_P3',{edit:false,add:false,del:false,view:false,search: false});
        $("#table_<?php echo $methodid ?>_keterangan_P3").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false, defaultSearch: 'cn', ignoreCase: false});
		
	    }
	 );
	 

					
	$( document ).ready(function() {
			
		$('#form_<?php echo $methodid ?>_date').datepicker(
			{
				format: 'yyyy-mm-dd',
				todayBtn: "linked",
				autoclose: true
			}
		);	
		
		
		$('#form_<?php echo $methodid ?>_date_start').datepicker(
			{
				format: 'yyyy-mm-dd',
				todayBtn: "linked",
				autoclose: true
			}
		);		
		
		$('#form_<?php echo $methodid ?>_date_end').datepicker(
			{
				format: 'yyyy-mm-dd',
				todayBtn: "linked",
				autoclose: true
			}
		);
      
	   init();
		
	});
	
	 
function search_dashboard_<?php echo $methodid ?>(){
		date_start = $('#form_<?php echo $methodid ?>_date_start').val();
		date_end = $('#form_<?php echo $methodid ?>_date_end').val();
		
		 var data_send={
             '<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
             ,date_start:date_start
		     ,date_end:date_end
	     }; 
		 
		$.ajax({
				url: baseurl +'<?php echo $class_uri ?>/find_dashboard',
				data: data_send,
				dataType: 'json',
				method: 'post',
				success: function(data){
						//data['jumlah_hari'];
					$('#ket_<?php echo $methodid ?>_M').text(data['jumlah_M']);
					$('#ket_<?php echo $methodid ?>_S').text(data['jumlah_S']);
					$('#ket_<?php echo $methodid ?>_C').text(data['jumlah_cuti']);
					//$('#ket_<?php echo $methodid ?>_CL').text(data['jumlah_cuti_lahir']);
					$('#ket_<?php echo $methodid ?>_P3').text(data['jumlah_P3']);
					
						$("#table_<?php echo $methodid ?>_keterangan_M").jqGrid('setGridParam', 
	                		{
	                			postData: {
	                				'<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
	                				 ,ket:'M'
	                				 ,date_start:date_start
	                				 ,date_end:date_end
	                				} 
	                	   		}
	                	);
                        $('#table_<?php echo $methodid ?>_keterangan_M').trigger( 'reloadGrid' );
					  
					    $("#table_<?php echo $methodid ?>_keterangan_S").jqGrid('setGridParam', 
	                		{
	                			postData: {
	                				'<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
	                				 ,ket:'S'
	                				 ,date_start:date_start
	                				 ,date_end:date_end
	                				} 
	                	   		}
	                	);
                        $('#table_<?php echo $methodid ?>_keterangan_S').trigger( 'reloadGrid' );
					  
					    $("#table_<?php echo $methodid ?>_keterangan_C").jqGrid('setGridParam', 
	                		{
	                			postData: {
	                				'<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
	                				 ,ket:'CT'
	                				 ,date_start:date_start
	                				 ,date_end:date_end
	                				} 
	                	   		}
	                	);
                        $('#table_<?php echo $methodid ?>_keterangan_C').trigger( 'reloadGrid' );
						
						$("#table_<?php echo $methodid ?>_keterangan_P3").jqGrid('setGridParam', 
	                		{
	                			postData: {
	                				'<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
	                				 ,ket:'P3'
	                				 ,date_start:date_start
	                				 ,date_end:date_end
	                				} 
	                	   		}
	                	);
                        $('#table_<?php echo $methodid ?>_keterangan_P3').trigger( 'reloadGrid' );
					  
					  
					  
					
					// ===== untuk grafik =========
					 var ctx = document.getElementById('content_<?php echo $methodid ?>_chart').getContext('2d');
                    	 // alert (ctx);
  	                  var chart = new Chart(ctx, {
                           // The type of chart we want to create
                           type: 'bar',
                           // The data for our dataset
                           data: {
                               labels: ['M-(Absen)','S-Sakit','C-cuti','CL-cuti lahir','P2-ijin','P3','Ip'],
                               datasets: [{
                                   label:'M',
                                   backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)','rgb(175, 238, 239)','rgb(184, 134, 11)','rgb (169, 169, 169)',
  	                 			                  'rgb(85, 107, 47)'],
                                   borderColor: ['rgb(255, 99, 132)'],
                                   data: [data['jumlah_M'],data['jumlah_S'],data['jumlah_cuti'],data['jumlah_cuti_lahir'],
  	                 			       data['jumlah_P2'],data['jumlah_P3'],data['jumlah_IP'] ]
                               }]
                           },
                           // Configuration options go here
                           options: {
                               scales: {
                                   yAxes: [{
                                       ticks: {
                                           beginAtZero:true
                                       }
                                   }]
                               }
                           }
                        });
					
				},
				error: function(xhr,error){
					show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
					check_submit = 0;
				}
			 })
		//alert(karyawan_lama_kerja);
		//date_end = $('#form_<?php echo $methodid ?>_date_end').val();  
	
	
	}
	
	function search_<?php echo $methodid ?>(){
		karyawan_name = $('#form_<?php echo $methodid ?>_karyawan_name').val();
		departemen = $('#form_<?php echo $methodid ?>_karyawan_departemen').val();
		date = $('#form_<?php echo $methodid ?>_date').val();
		//date_end = $('#form_<?php echo $methodid ?>_date_end').val();  
	
		$("#table_<?php echo $methodid ?>_absen_karyawan").jqGrid('setGridParam', 
			{
				postData: {
					'<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
					 ,karyawan_name:karyawan_name
					 ,departemen:departemen
					 ,date:date
					
				} 
			
			}
		);
      
	  $('#table_<?php echo $methodid ?>_absen_karyawan').trigger( 'reloadGrid' );
	}
	

	
	function print_<?php echo $methodid ?>_absen_1(format){
		karyawan_name = $('#form_<?php echo $methodid ?>_karyawan_name').val();
		departemen = $('#form_<?php echo $methodid ?>_karyawan_departemen').val();
		date = $('#form_<?php echo $methodid ?>_date').val();
       //alert (karyawan_name);
       var data_send={
         '<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
         ,date:date
		 ,karyawan_name:karyawan_name
		 ,departemen:departemen
         ,format:format
         ,print:1
	   }; 
      $.ajax({
         type: "POST",
         url:baseurl + '<?php echo $class_uri ?>/loaddata',
         data: data_send,
         dataType : 'json',
         success: function(msg){
            if (!msg.valid){  
               show_error('show','error',msg.des);
               return false;
            }else{
               download_file('<?php echo $methodid ?>',msg.xfile,msg.namafile,'<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>'             ); 
               return false; 
            } 
         }
      }) ;   
	}
	
	function print_report_<?php echo $methodid ?>(format){
		departemen = $('#form_<?php echo $methodid ?>_karyawan_departemen1').val();
		divisi = $('#form_<?php echo $methodid ?>_karyawan_divisi').val();
		sub_divisi = $('#form_<?php echo $methodid ?>_karyawan_sub_divisi').val();
		lama_kerja = $('#form_<?php echo $methodid ?>_karyawan_lama_kerja').val();
		date_start = $('#form_<?php echo $methodid ?>_date_start').val();
		date_end = $('#form_<?php echo $methodid ?>_date_end').val();
       //alert (departemen +' - '+ sub_divisi);
       var data_send={
         '<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
		 ,karyawan_departemen:departemen
		 ,karyawan_divisi:divisi
		 ,karyawan_sub_divisi:sub_divisi
		 ,karyawan_lama_kerja:lama_kerja
         ,date_start:date_start
		 ,date_end:date_end
		 ,format:format
         ,print:1
	   }; 
      $.ajax({
         type: "POST",
         url:baseurl + '<?php echo $class_uri ?>/loaddata_report',
         data: data_send,
         dataType : 'json',
         success: function(msg){
            if (!msg.valid){  
               show_error('show','error',msg.des);
               return false;
            }else{
               download_file('<?php echo $methodid ?>',msg.xfile,msg.namafile,'<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>'             ); 
               return false; 
            } 
         }
      }) ;   
	}
	

	function countDays(start, end /* [, holiday [, excludeDays]]  */) {
         // 3rd argument is array of holiday
      if (arguments.length >= 3) {
          var holiday = arguments[2];
           // convert to timestamp
          holiday = holiday.map( function(value, index, array) {
             return value.getTime();
              });     
             }
         else {
             var holiday = [];
       }
     
        // 4th argument is array of exclude days, default are Sunday and Saturday 
        if (arguments.length >= 4) {
           var excludeDays = arguments[3];
         }
         else {
              var excludeDays = [
                0      // Sunday 
                // 6       // Saturday
              ];
          }
     
         // milisecond per day
         var oneDay = 1000 * 24 * 60 *60;
     
         // different of start and end day
         var diff = Math.ceil((end.getTime() - start.getTime()) / oneDay);
          
         // count days
         var days = 0;
    for (var i = 0; i <= diff; i++) {
         
        // current date
        var now = new Date(start.getFullYear(), start.getMonth(), start.getDate() + i);
         
        // flag count the day or not
        var isCount = true;
         
        // exclude holiday
        if (holiday.indexOf(now.getTime()) > -1) {
            isCount = false;
        }
         
        // exclude days
        if (excludeDays.indexOf(now.getDay()) > -1) {
            isCount = false;
        }
         
        if (isCount) {
            days++;
        }
         
    }
     
    return days;
   }
</script>
