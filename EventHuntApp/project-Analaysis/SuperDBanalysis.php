<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="CMPE226 Assignment1">
    <meta name="author" content="SuperDB">

    <title>Query Results</title>

    <!-- Bootstrap core CSS -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->

    <!-- Custom styles for this template -->

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <![endif]-->
</head>

<body>

<div class="container">
<h1>Query Results</h1>
    <div class="panel panel-default">

<!--        <div class="panel-heading">Panel heading without title</div>-->
        <div class="panel-body">
        <?php
           function createTable($query,$con){
                $data = $con->query($query);
                $data->setFetchMode(PDO::FETCH_ASSOC);
                print "<table border='1'>\n";
                $doHeader = true;
                foreach ($data as $row) {
                    
                    
                    // The header row before the first data row.
                    if ($doHeader) {
                        print "        <tr>\n";
                        foreach ($row as $name => $value) {
                            print "            <th>$name</th>\n";
                        }
                        print "        </tr>\n";
                        
                        $doHeader = false;
                    }
                    
                    // Data row.
                    print "            <tr>\n";
                    foreach ($row as $name => $value) {
                        print "                <td>$value</td>\n";
                    }
                    print "            </tr>\n";
                }
                
                print "        </table>\n";
                
            }
            
        try {
                    // Connect to the database.
            $con = new PDO("mysql:host=ec2-35-165-18-123.us-west-2.compute.amazonaws.com;dbname=eventgo","dora", "yuanyuan");
                
            $con->setAttribute(PDO::ATTR_ERRMODE,
                        PDO::ERRMODE_EXCEPTION);
                        
            $queryTable = filter_input(INPUT_POST,"queryTable");
            $year=filter_input(INPUT_POST,"year");
            $month = filter_input(INPUT_POST,"month");
            $quater= filter_input(INPUT_POST,"quarter");
            $day = filter_input(INPUT_POST,"day"); 
            $drill = filter_input(INPUT_POST,"drill");
            $stateOfEvent=filter_input(INPUT_POST,"stateOfEvent");
            $eventType=filter_input(INPUT_POST,"eventType");
            $stateOfUser=filter_input(INPUT_POST,"stateOfUser");
            $userGender=filter_input(INPUT_POST,"userGender");
            $payfor = filter_input(INPUT_POST,"payfor");
            $cardType = filter_input(INPUT_POST,"cardType");
            $AgeRangesmall = filter_input(INPUT_POST,"AgeRangesmall");
            $AgeRangebig = filter_input(INPUT_POST,"AgeRangebig");
            $YearRangesmall = filter_input(INPUT_POST,"YearRangesmall");
            $YearRangebig = filter_input(INPUT_POST,"YearRangebig");
            $feeRangesmall = filter_input(INPUT_POST,"feeRangesmall");
            $feeRangebig = filter_input(INPUT_POST,"feeRangebig");

            if($queryTable == "eventNo")
            {
                if($year != "select"){
                    $eventNo["Year"] = $year;
                }
                
                if($YearRangesmall!='' && $YearRangebig !=''){
                      $eventNo["Year"] = ' between '.$YearRangesmall.' and '.$YearRangebig;                  
                }
                
                $eventNo["TypeName"] = $eventType;
                $eventNo["Month"] = $month;
                
                if($quater!=''){
                     $eventNo["Quarter"] = $quater;
                }
                $eventNo["DayOfMonth"] = $day;
                $eventNo["State"] = $stateOfEvent;
                
                if($feeRangesmall!='' && $feeRangebig !=''){
                      $eventNo["Year"] = ' between '.$feeRangesmall.' and '.$feeRangebig;                  
                }
                $queryFirst="SELECT SUM(eno.NoOfEvent) as total_number_of_event,";
                $queryMiddle = "from EVENTNO eno, TYPE_Dimension td, EVENT_LOCATION_Dimension eld, CALENDAR_Dimension c where c.CalendarKey = eno.CalendarKey AND eld.ELocationKey = eno.ELocationKey and eno.TypeKey = td.TypeKey ";
                $queryLast = " group by ";
                foreach ($eventNo as $key => $value) {
                    if($key == "Year")
                    {
                        if($year == 'select'){
                            $queryFirst .= "c.Year,";
                            $queryLast .= "c.Year,";
                            $queryMiddle .= "and c.Year ".$value." ";
                        }
                        else
                        {
                            $queryFirst .= "c.Year,";
                            $queryLast .= "c.Year,";
                            $queryMiddle .= " and c.Year='".$value."' ";                        
                        }
                        
                    }
                    else if($key =="TypeName" &&  $value != "select")
                    {
                        $queryFirst .= "td.TypeName,";
                        $queryLast .= "td.TypeName,";
                        $queryMiddle .= " and td.TypeName='".$value."' ";
                    }
                    else if($key == "Month")
                    {
                        if($value != "select" ){
                            $queryFirst .= "c.Month,";
                            $queryLast .= "c.Month,";
                            $queryMiddle .= "and c.Month='".$value."' ";
                        }
                        else if($value == "select" && $drill == "everyMonth")
                        {
                            $queryFirst .= "c.Month,";
                            $queryLast .= "c.Month,";
                        }
                    }
                    else if($key == "Quarter")
                    {
                        $queryFirst .= "c.Quarter,";
                        $queryLast .= "c.Quarter,";
                        $queryMiddle .= "and c.Quarter in (".$value.") ";
                    }
                    else if($key == "DayOfMonth" && $value != "select")
                    {
                        $queryFirst .= "c.DayOfMonth,";
                        $queryLast .= "c.DayOfMonth,";
                        $queryMiddle .= "and c.DayOfMonth='".$value."' ";
                    }
                    else if($key == "State" && $value != "select")
                    {
                        $queryFirst .= "eld.State,";
                        $queryLast .= "eld.State,";
                        $queryMiddle .= "and eld.State='".$value."' ";
                    }
                    
                }
            
                $queryFirst=substr_replace($queryFirst, " ", -1);
                $queryMiddle=substr_replace($queryMiddle, " ", -1);
                $queryLast=substr_replace($queryLast, ";", -1);
                $query = $queryFirst.$queryMiddle.$queryLast;
                createTable($query,$con);
            }
           
            else if($queryTable == "participantEEC")
            {
                if($year != "select"){
                $eventNo["Year"] = $year;
                 }
            
                if($YearRangesmall!='' && $YearRangebig !=''){
                      $eventNo["Year"] = ' between '.$YearRangesmall.' and '.$YearRangebig;                  
                }
                $eventNo["EventType"] = $eventType;
                $eventNo["Month"] = $month;
            if($quater!=''){
                 $eventNo["Quarter"] = $quater;
            }
                $eventNo["DayOfMonth"] = $day;
                $eventNo["State"] = $stateOfEvent;
                if($feeRangesmall!='' && $feeRangebig !=''){
                  $eventNo["EventFee"] = ' between '.$feeRangesmall.' and '.$feeRangebig;                  
                }
                
                $queryFirst="SELECT SUM(P.NoOfParticipant) as total_number_of_participant, ";
                $queryMiddle = "FROM PARTICIPANTPerEEC AS P, EVENT_LOCATION_Dimension L, EVENT_Dimension E, CALENDAR_Dimension c WHERE c.CalendarKey = P.CalendarKey AND L.ELocationKey = P.ELocationKey AND E.EventKey = P.EventKey  ";
                $queryLast = " group by ";
                
                foreach ($eventNo as $key => $value) {
                if($key == "Year")
                {
                    if($year == 'select'){
                        $queryFirst .= "c.Year,";
                        $queryLast .= "c.Year,";
                        $queryMiddle .= "and c.Year ".$value." ";
                    }
                    else
                    {
                        $queryFirst .= "c.Year,";
                        $queryLast .= "c.Year,";
                        $queryMiddle .= " and c.Year='".$value."' ";                        
                    }
                    
                }
                else if($key =="EventType" &&  $value != "select")
                {
                    $queryFirst .= "E.EventType,";
                    $queryLast .= "E.EventType,";
                    $queryMiddle .= " and E.EventType='".$value."' ";
                }
                    else if($key == "Month")
                    {
                        if($value != "select" ){
                            $queryFirst .= "c.Month,";
                            $queryLast .= "c.Month,";
                            $queryMiddle .= "and c.Month='".$value."' ";
                        }
                        else if($value == "select" && $drill == "everyMonth")
                        {
                            $queryFirst .= "c.Month,";
                            $queryLast .= "c.Month,";
                        }
                    }
                else if($key == "Quarter" &&  $value != "select")
                {
                    echo "quarter".$value;
                    $queryFirst .= "c.Quarter,";
                    $queryLast .= "c.Quarter,";
                    $queryMiddle .= "and c.Quarter in (".$value.") ";
                }
                else if($key == "DayOfMonth" && $value != "select")
                {
                    $queryFirst .= "c.DayOfMonth,";
                    $queryLast .= "c.DayOfMonth,";
                    $queryMiddle .= "and c.DayOfMonth='".$value."' ";
                }
                else if($key == "State" && $value != "select")
                {
                    $queryFirst .= "L.State,";
                    $queryLast .= "L.State,";
                    $queryMiddle .= "and L.State='".$value."' ";
                }
                
                else if($key == "EventFee")
                {
                    $queryFirst .= "E.EventFee,";
                    $queryLast .= "E.EventFee,";
                    $queryMiddle .= "and E.EventFee ".$value." ";
                }
            }
                $queryFirst=substr_replace($queryFirst, " ", -1);
                $queryMiddle=substr_replace($queryMiddle, " ", -1);
                $queryLast=substr_replace($queryLast, ";", -1);
                $query = $queryFirst.$queryMiddle.$queryLast;
                
                createTable($query,$con);
            }
 
             else if($queryTable == "participantUEC")
            {
               if($year != "select"){
                $eventNo["Year"] = $year;
                }
            
                if($YearRangesmall!='' && $YearRangebig !=''){
                      $eventNo["Year"] = ' between '.$YearRangesmall.' and '.$YearRangebig;                  
                }
                $eventNo["EventType"] = $eventType;
                $eventNo["Month"] = $month;
            if($quater!=''){
                 $eventNo["Quarter"] = $quater;
            }
                $eventNo["DayOfMonth"] = $day;
                $eventNo["State"] = $stateOfUser;
                if($feeRangesmall!='' && $feeRangebig !=''){
                  $eventNo["EventFee"] = ' between '.$feeRangesmall.' and '.$feeRangebig;                  
                }
                
                $queryFirst="SELECT SUM(P.NoOfParticipant) as total_number_of_participant, ";
                $queryMiddle = "FROM   PARTICIPANTPerUEC AS P, USER_LOCATION_Dimension L,   EVENT_Dimension E,   CALENDAR_Dimension c WHERE   c.CalendarKey = P.CalendarKey AND L.ULocationKey = P.ULocationKey AND E.EventKey = P.EventKey ";
                $queryLast = " group by ";
                
                foreach ($eventNo as $key => $value) {
                if($key == "Year")
                {
                    if($year == 'select'){
                        $queryFirst .= "c.Year,";
                        $queryLast .= "c.Year,";
                        $queryMiddle .= "and c.Year ".$value." ";
                    }
                    else
                    {
                        $queryFirst .= "c.Year,";
                        $queryLast .= "c.Year,";
                        $queryMiddle .= " and c.Year='".$value."' ";                        
                    }
                    
                }
                else if($key =="EventType" &&  $value != "select")
                {
                    $queryFirst .= "E.EventType,";
                    $queryLast .= "E.EventType,";
                    $queryMiddle .= " and E.EventType='".$value."' ";
                }
                    else if($key == "Month")
                    {
                        if($value != "select" ){
                            $queryFirst .= "c.Month,";
                            $queryLast .= "c.Month,";
                            $queryMiddle .= "and c.Month='".$value."' ";
                        }
                        else if($value == "select" && $drill == "everyMonth")
                        {
                            $queryFirst .= "c.Month,";
                            $queryLast .= "c.Month,";
                        }
                    }
                else if($key == "Quarter" &&  $value != "select")
                {
                    echo "quarter".$value;
                    $queryFirst .= "c.Quarter,";
                    $queryLast .= "c.Quarter,";
                    $queryMiddle .= "and c.Quarter in (".$value.") ";
                }
                else if($key == "DayOfMonth" && $value != "select")
                {
                    $queryFirst .= "c.DayOfMonth,";
                    $queryLast .= "c.DayOfMonth,";
                    $queryMiddle .= "and c.DayOfMonth='".$value."' ";
                }
                else if($key == "State" && $value != "select")
                {
                    $queryFirst .= "L.State,";
                    $queryLast .= "L.State,";
                    $queryMiddle .= "and L.State='".$value."' ";
                }
                
                else if($key == "EventFee")
                {
                    $queryFirst .= "E.EventFee,";
                    $queryLast .= "E.EventFee,";
                    $queryMiddle .= "and E.EventFee ".$value." ";
                }
            }
                $queryFirst=substr_replace($queryFirst, " ", -1);
                $queryMiddle=substr_replace($queryMiddle, " ", -1);
                $queryLast=substr_replace($queryLast, ";", -1);
                $query = $queryFirst.$queryMiddle.$queryLast;
                
                createTable($query,$con);
            }
            
            else if($queryTable == "eventFeeType")
            {
            if($year != "select"){
                $eventNo["Year"] = $year;
            }
            
            if($YearRangesmall!='' && $YearRangebig !=''){
                  $eventNo["Year"] = ' between '.$YearRangesmall.' and '.$YearRangebig;                  
            }
                $eventNo["TypeName"] = $eventType;
                $eventNo["Month"] = $month;
            if($quater!=''){
                 $eventNo["Quarter"] = $quater;
            }
                $eventNo["DayOfMonth"] = $day;
                $eventNo["State"] = $stateOfEvent;
                
                $queryFirst="SELECT SUM(ef.EventFee) as total_event_fee, ";
                $queryMiddle = "from EVENTFEEPerTYPE ef, TYPE_Dimension td, EVENT_LOCATION_Dimension L, CALENDAR_Dimension c WHERE c.CalendarKey = ef.CalendarKey AND L.ELocationKey = ef.ELocationKey and ef.TypeKey = td.TypeKey ";
                $queryLast = " group by ";
                
                foreach ($eventNo as $key => $value) {
                if($key == "Year")
                {
                    if($year == 'select'){
                        $queryFirst .= "c.Year,";
                        $queryLast .= "c.Year,";
                        $queryMiddle .= "and c.Year ".$value." ";
                    }
                    else
                    {
                        $queryFirst .= "c.Year,";
                        $queryLast .= "c.Year,";
                        $queryMiddle .= " and c.Year='".$value."' ";                        
                    }
                    
                }
                else if($key =="TypeName" &&  $value != "select")
                {
                    $queryFirst .= "td.TypeName,";
                    $queryLast .= "td.TypeName,";
                    $queryMiddle .= " and td.TypeName='".$value."' ";
                }
                    else if($key == "Month")
                    {
                        if($value != "select" ){
                            $queryFirst .= "c.Month,";
                            $queryLast .= "c.Month,";
                            $queryMiddle .= "and c.Month='".$value."' ";
                        }
                        else if($value == "select" && $drill == "everyMonth")
                        {
                            $queryFirst .= "c.Month,";
                            $queryLast .= "c.Month,";
                        }
                    }
                else if($key == "Quarter" &&  $value != "select")
                {
                    echo "quarter".$value;
                    $queryFirst .= "c.Quarter,";
                    $queryLast .= "c.Quarter,";
                    $queryMiddle .= "and c.Quarter in (".$value.") ";
                }
                else if($key == "DayOfMonth" && $value != "select")
                {
                    $queryFirst .= "c.DayOfMonth,";
                    $queryLast .= "c.DayOfMonth,";
                    $queryMiddle .= "and c.DayOfMonth='".$value."' ";
                }
                else if($key == "State" && $value != "select")
                {
                    $queryFirst .= "L.State,";
                    $queryLast .= "L.State,";
                    $queryMiddle .= "and L.State='".$value."' ";
                }
            }
                $queryFirst=substr_replace($queryFirst, " ", -1);
                $queryMiddle=substr_replace($queryMiddle, " ", -1);
                $queryLast=substr_replace($queryLast, ";", -1);
                $query = $queryFirst.$queryMiddle.$queryLast;
                
                createTable($query,$con);
            }
            else if($queryTable == "paymentCTU")
            {
            if($year != "select"){
                $eventNo["Year"] = $year;
            }
            
            if($YearRangesmall!='' && $YearRangebig !=''){
                  $eventNo["Year"] = ' between '.$YearRangesmall.' and '.$YearRangebig;                  
            }
                $eventNo["TypeName"] = $eventType;
                $eventNo["Month"] = $month;
            if($quater!=''){
                 $eventNo["Quarter"] = $quater;
            }
                $eventNo["DayOfMonth"] = $day;
                $eventNo["State"] = $stateOfUser;
                $eventNo["PayFor"] = $payfor;
                
                $queryFirst="SELECT SUM(p.PaidAmount) as total_paid_amount, ";
                $queryMiddle = "from USER_LOCATION_Dimension L, TYPE_Dimension td, CALENDAR_Dimension c, PAYMENTPerCTU p WHERE p.ULocationKey = L.ULocationKey and p.CalendarKey = c.CalendarKey and td.TypeKey = p.TypeKey ";
                $queryLast = " group by ";
                
                foreach ($eventNo as $key => $value) {
                if($key == "Year")
                {
                    if($year == 'select'){
                        $queryFirst .= "c.Year,";
                        $queryLast .= "c.Year,";
                        $queryMiddle .= "and c.Year ".$value." ";
                    }
                    else
                    {
                        $queryFirst .= "c.Year,";
                        $queryLast .= "c.Year,";
                        $queryMiddle .= " and c.Year='".$value."' ";                        
                    }
                    
                }
                else if($key =="TypeName" &&  $value != "select")
                {
                    $queryFirst .= "td.TypeName,";
                    $queryLast .= "td.TypeName,";
                    $queryMiddle .= " and td.TypeName='".$value."' ";
                }
                    else if($key == "Month")
                    {
                        if($value != "select" ){
                            $queryFirst .= "c.Month,";
                            $queryLast .= "c.Month,";
                            $queryMiddle .= "and c.Month='".$value."' ";
                        }
                        else if($value == "select" && $drill == "everyMonth")
                        {
                            $queryFirst .= "c.Month,";
                            $queryLast .= "c.Month,";
                        }
                    }
                else if($key == "Quarter" &&  $value != "select")
                {
                    echo "quarter".$value;
                    $queryFirst .= "c.Quarter,";
                    $queryLast .= "c.Quarter,";
                    $queryMiddle .= "and c.Quarter in (".$value.") ";
                }
                else if($key == "DayOfMonth" && $value != "select")
                {
                    $queryFirst .= "c.DayOfMonth,";
                    $queryLast .= "c.DayOfMonth,";
                    $queryMiddle .= "and c.DayOfMonth='".$value."' ";
                }
                else if($key == "State" && $value != "select")
                {
                    $queryFirst .= "L.State,";
                    $queryLast .= "L.State,";
                    $queryMiddle .= "and L.State='".$value."' ";
                }
               else if($key == "PayFor" && $value != "select")
                {
                    $queryFirst .= "p.PayFor,";
                    $queryLast .= "p.PayFor,";
                    $queryMiddle .= "and p.PayFor='".$value."' ";
                }
                
            }
                $queryFirst=substr_replace($queryFirst, " ", -1);
                $queryMiddle=substr_replace($queryMiddle, " ", -1);
                $queryLast=substr_replace($queryLast, ";", -1);
                $query = $queryFirst.$queryMiddle.$queryLast;
                
                createTable($query,$con);
            }
            
            else if($queryTable == "paymentUCTE")
            {
            if($year != "select"){
                $eventNo["Year"] = $year;
            }
            
            if($YearRangesmall!='' && $YearRangebig !=''){
                  $eventNo["Year"] = ' between '.$YearRangesmall.' and '.$YearRangebig;                  
            }
                $eventNo["TypeName"] = $eventType;
                $eventNo["Month"] = $month;
            if($quater!=''){
                 $eventNo["Quarter"] = $quater;
            }
                $eventNo["DayOfMonth"] = $day;
                $eventNo["State"] = $stateOfEvent;
                $eventNo["UserGender"] = $userGender;
                $eventNo["PayFor"] = $payfor;
                if($AgeRangesmall!='' && $AgeRangebig !=''){
                  $eventNo["UserAge"] = ' between '.$AgeRangesmall.' and '.$AgeRangebig;                  
                }
                
                $queryFirst="SELECT SUM(p.PayAmount) as total_paid_amount, ";
                $queryMiddle = "from EVENT_LOCATION_Dimension L, TYPE_Dimension td, CALENDAR_Dimension c, USER_Dimension u, PAYMENTPerUCTE p WHERE p.ELocationKey = L.ELocationKey and p.CalendarKey = c.CalendarKey and td.TypeKey = p.TypeKey ";
                $queryLast = " group by ";
                
                foreach ($eventNo as $key => $value) {
                if($key == "Year")
                {
                    if($year == 'select'){
                        $queryFirst .= "c.Year,";
                        $queryLast .= "c.Year,";
                        $queryMiddle .= "and c.Year ".$value." ";
                    }
                    else
                    {
                        $queryFirst .= "c.Year,";
                        $queryLast .= "c.Year,";
                        $queryMiddle .= " and c.Year='".$value."' ";                        
                    }
                    
                }
                else if($key =="TypeName" &&  $value != "select")
                {
                    $queryFirst .= "td.TypeName,";
                    $queryLast .= "td.TypeName,";
                    $queryMiddle .= " and td.TypeName='".$value."' ";
                }
                    else if($key == "Month")
                    {
                        if($value != "select" ){
                            $queryFirst .= "c.Month,";
                            $queryLast .= "c.Month,";
                            $queryMiddle .= "and c.Month='".$value."' ";
                        }
                        else if($value == "select" && $drill == "everyMonth")
                        {
                            $queryFirst .= "c.Month,";
                            $queryLast .= "c.Month,";
                        }
                    }
                else if($key == "Quarter" &&  $value != "select")
                {
                    echo "quarter".$value;
                    $queryFirst .= "c.Quarter,";
                    $queryLast .= "c.Quarter,";
                    $queryMiddle .= "and c.Quarter in (".$value.") ";
                }
                else if($key == "DayOfMonth" && $value != "select")
                {
                    $queryFirst .= "c.DayOfMonth,";
                    $queryLast .= "c.DayOfMonth,";
                    $queryMiddle .= "and c.DayOfMonth='".$value."' ";
                }
                else if($key == "State" && $value != "select")
                {
                    $queryFirst .= "L.State,";
                    $queryLast .= "L.State,";
                    $queryMiddle .= "and L.State='".$value."' ";
                }
               else if($key == "PayFor" && $value != "select")
                {
                    $queryFirst .= "p.PayFor,";
                    $queryLast .= "p.PayFor,";
                    $queryMiddle .= "and p.PayFor='".$value."' ";
                }
                else if($key == "UserGender" && $value != "select")
                {
                    $queryFirst .= "u.UserGender,";
                    $queryLast .= "u.UserGender,";
                    $queryMiddle .= "and u.UserGender='".$value."' ";
                }
                
                else if($key == "UserAge" && $value != "select")
                {
                    $queryFirst .= "u.UserAge,";
                    $queryLast .= "u.UserAge,";
                    $queryMiddle .= "and u.UserAge ".$value." ";
                }
                
            }
                $queryFirst=substr_replace($queryFirst, " ", -1);
                $queryMiddle=substr_replace($queryMiddle, " ", -1);
                $queryLast=substr_replace($queryLast, ";", -1);
                $query = $queryFirst.$queryMiddle.$queryLast;
                createTable($query,$con);
            }
            else if($queryTable == "paymentDetail")
            {
            if($year != "select"){
                $eventNo["Year"] = $year;
            }
            
            if($YearRangesmall!='' && $YearRangebig !=''){
                  $eventNo["Year"] = ' between '.$YearRangesmall.' and '.$YearRangebig;                  
            }
                $eventNo["EventType"] = $eventType;
                $eventNo["Month"] = $month;
            if($quater!=''){
                 $eventNo["Quarter"] = $quater;
            }
                $eventNo["DayOfMonth"] = $day;
                $eventNo["UserState"] = $stateOfUser;
                $eventNo["UserGender"] = $userGender;
                $eventNo["PaidFor"] = $payfor;
                $eventNo["CardType"] = $cardType;
                if($feeRangesmall!='' && $feeRangebig !=''){
                  $eventNo["EventFee"] = ' between '.$feeRangesmall.' and '.$feeRangebig;                  
                }
                if($AgeRangesmall!='' && $AgeRangebig !=''){
                  $eventNo["UserAge"] = ' between '.$AgeRangesmall.' and '.$AgeRangebig;                  
                }
                
                $queryFirst="SELECT u.FirstName,u.LastName,p.PaidAmount,p.TransactionID,p.PaidFor,c.FullDate,p.PaidTime, cd.CardNumber,e.EventID, ";
                $queryMiddle = "from USER_Dimension u, CARD_Dimension cd, EVENT_Dimension e, CALENDAR_Dimension c, PAYMENT_DETAIL
p where p.UserKey = u.UserKey and p.CalendarKey = c.CalendarKey and p.CardKey = cd.CardKey and e.EventKey = p.EventKey ";
                $queryLast = " order by ";
                
                foreach ($eventNo as $key => $value) {
                if($key == "Year")
                {
                    if($year == 'select'){
                        $queryMiddle .= "and c.Year ".$value." ";
                    }
                    else
                    {
                        $queryMiddle .= " and c.Year='".$value."' ";                        
                    }
                    
                }
                else if($key =="EventType" &&  $value != "select")
                {
                    $queryFirst .= "e.EventType,";
                    $queryLast .= "e.EventType,";
                    $queryMiddle .= " and e.EventType='".$value."' ";
                }
                    else if($key == "Month")
                    {
                        if($value != "select" ){

                            $queryMiddle .= "and c.Month='".$value."' ";
                        }
                        else if($value == "select" && $drill == "everyMonth")
                        {
                            $queryFirst .= "c.Month,";
                            $queryLast .= "c.Month,";
                        }
                    }
                else if($key == "Quarter" &&  $value != "select")
                {
                    
                    $queryFirst .= "c.Quarter,";
                    $queryLast .= "c.Quarter,";
                    $queryMiddle .= "and c.Quarter in (".$value.") ";
                }
                else if($key == "DayOfMonth" && $value != "select")
                {
                    $queryMiddle .= "and c.DayOfMonth='".$value."' ";
                }
                else if($key == "UserState" && $value != "select")
                {
                    $queryFirst .= "u.UserState,";
                    $queryLast .= "u.UserState,";
                    $queryMiddle .= "and u.UserState='".$value."' ";
                }
               else if($key == "PaidFor" && $value != "select")
                {
                    $queryFirst .= "p.PaidFor,";
                    $queryLast .= "p.PaidFor,";
                    $queryMiddle .= "and p.PaidFor='".$value."' ";
                }
                else if($key == "UserGender" && $value != "select")
                {
                    $queryFirst .= "u.UserGender,";
                    $queryLast .= "u.UserGender,";
                    $queryMiddle .= "and u.UserGender='".$value."' ";
                }
                else if($key == "CardType" && $value != "select")
                {
                    $queryFirst .= "cd.CardType,";
                    $queryLast .= "cd.CardType,";
                    $queryMiddle .= "and cd.CardType='".$value."' ";
                }
                
                else if($key == "UserAge" && $value != "select")
                {
                    $queryFirst .= "u.UserAge,";
                    $queryLast .= "u.UserAge,";
                    $queryMiddle .= "and u.UserAge ".$value." ";
                }
                
            else if($key == "EventFee" && $value != "select")
                {
                    $queryFirst .= "e.EventFee,";
                    $queryLast .= "e.EventFee,";
                    $queryMiddle .= "and e.EventFee ".$value." ";
                }
                
            }
                $queryFirst=substr_replace($queryFirst, " ", -1);
                $queryMiddle=substr_replace($queryMiddle, " ", -1);
                $queryLast=substr_replace($queryLast, ";", -1);
                $query = $queryFirst.$queryMiddle.$queryLast;
                createTable($query,$con);
            }
            
            else
            {
                echo "Please specify what do you want to analysis";
            }
            
                }catch(PDOException $ex) {
                    echo 'ERROR: '.$ex->getMessage();
                    }
            
            ?>
        </div>
    </div>
</div>
</body>
</html>