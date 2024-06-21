<script type="text/javascript">
	
		Morris.Area({
				element: 'morris-area',
				pointSize: 0,
				lineWidth: 0,
				data: [
					{ y: '2011', a: 50, b: 60 },
					{ y: '2012', a: 75,  b: 55 },
					{ y: '2013', a: 40,  b: 60 },
					{ y: '2014', a: 65,  b: 75 },
					{ y: '2015', a: 60,  b: 50 },
					{ y: '2016', a: 75,  b: 85 },
					{ y: '2017', a: 40, b: 50 },
				],
				xkey: 'y',
				ykeys: ['a', 'b'],
				labels: ['Series A', 'Series B'],
				hideHover: 'auto',
				resize: true,
				gridLineColor: '#efefef',
				lineColors: ['#17a2b8', "#e6e6e6"]
			});
	
		Morris.Line({
      element: 'morris-line',
      data: [
        { y: '2011', a: 50, b: 40 },
        { y: '2012', a: 75,  b: 65 },
        { y: '2013', a: 50,  b: 40 },
        { y: '2014', a: 75,  b: 65 },
        { y: '2015', a: 50,  b: 40 },
        { y: '2016', a: 75,  b: 65 },
        { y: '2017', a: 60,  b: 50 }
      ],
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['Series A', 'Series B'],
      fillOpacity: ['0.1'],
      pointFillColors:['#ffffff'],
      pointStrokeColors:['#999999'],
      behaveLikeLine: true,
      gridLineColor: '#efefef',
      hideHover: 'auto',
      lineWidth: '3px',
      pointSize: 0,
      preUnits: '$',
      resize: true,
      lineColors:['#dc3545 ', '#17a2b8']
    });
</script>