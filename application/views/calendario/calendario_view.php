<!doctype html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>Units view</title>
</head>
	<script src="<?php echo base_url('public/scheduler/codebase/dhtmlxscheduler.js');?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url('public/scheduler/codebase/ext/dhtmlxscheduler_units.js');?>" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="<?php echo base_url('public/scheduler/codebase/dhtmlxscheduler.css');?>" type="text/css" title="no title" charset="utf-8">
	
<style type="text/css" media="screen">
	html, body{
		margin:0px;
		padding:0px;
		height:100%;
		overflow:hidden;
	}	
</style>

<script type="text/javascript" charset="utf-8">
	function init() {
            var sections=[
			{key:1, label:"Consultorio 1"},
			{key:2, label:"Consultorio 2"},
			{key:3, label:"Consultorio 3"},
			{key:4, label:"Consultorio 4"}
		];
		
		scheduler.locale.labels.unit_tab = "Unit";
		scheduler.locale.labels.section_custom="Section";
		scheduler.config.details_on_create=true;
		scheduler.config.details_on_dblclick=true;
		scheduler.config.xml_date="%Y-%m-%d %H:%i";
		
		scheduler.config.lightbox.sections=[	
			{name:"description", height:130, map_to:"text", type:"textarea" , focus:true},
			{name:"custom", height:23, type:"select", options:sections, map_to:"section_id" },
			{name:"time", height:72, type:"time", map_to:"auto"}
		],
		
		scheduler.createUnitsView({
			name:"unit",
			property:"section_id",
			list:sections
		});
		scheduler.config.multi_day = true;
		
		scheduler.init('scheduler_here',new Date(2014,09,13),"unit");
		scheduler.load("get_notas");
                
//                var dp = new dataProcessor("get_notas");
//			dp.init(scheduler);
//                scheduler.init('scheduler_here',new Date(2009,10,1),"unit");
//                
//                scheduler.parse([
//                    {text:"Meeting",    start_date:"04/11/2013 14:00", end_date:"04/11/2013 17:00", section_id:1},
//                    {text:"Conference", start_date:"04/15/2013 12:00", end_date:"04/18/2013 19:00", section_id:2},
//                    {text:"Interview",  start_date:"04/24/2013 09:00", end_date:"04/24/2013 10:00", section_id:3}
//                ],"json");
	}
</script>

<body onload="init();">
	<div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:100%;'>
		<div class="dhx_cal_navline">
			<div class="dhx_cal_prev_button">&nbsp;</div>
			<div class="dhx_cal_next_button">&nbsp;</div>
			<div class="dhx_cal_today_button"></div>
			<div class="dhx_cal_date"></div>
			<div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
			<div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
			<div class="dhx_cal_tab" name="unit_tab" style="right:280px;"></div>
			<div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
		</div>
		<div class="dhx_cal_header">
		</div>
		<div class="dhx_cal_data">
		</div>		
	</div>
</body>