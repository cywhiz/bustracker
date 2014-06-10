<title>Megabus Schedule Checker</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/redmond/jquery-ui.css" type="text/css">
<link rel="stylesheet" href="index.css" type="text/css">
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>

<script>
$(function () {
    $("#startDateCA").datepicker({
        minDate: 0,
        dateFormat: 'yy-mm-dd',
        onSelect: function (selected) {
            $("#endDateCA").datepicker("option", "minDate", selected)
        }
    });
    $("#endDateCA").datepicker({
        minDate: 0,
        dateFormat: 'yy-mm-dd',
        onSelect: function (selected) {
            $("#startDateCA").datepicker("option", "maxDate", selected)
        }
    });
    $("#startDateUS").datepicker({
        minDate: 0,
        dateFormat: 'yy-mm-dd',
        onSelect: function (selected) {
            $("#endDateUS").datepicker("option", "minDate", selected)
        }
    });
    $("#endDateUS").datepicker({
        minDate: 0,
        dateFormat: 'yy-mm-dd',
        onSelect: function (selected) {
            $("#startDateUS").datepicker("option", "maxDate", selected)
        }
    });
});
</script>

<body>
<img src="logo.png" alt="logo"><br>
<img src="logo2.png" alt="logo2">

<form action="canada.php" method="post">
<table class="country">
<tr><td><img src="canada.png" alt="Canada" height="25" width="50"></td></tr>
<tr><td class="left">Start Date:</td><td class="right"><input type="text" class="text" id="startDateCA" name="startDate"></td></tr>
<tr><td class="left">End Date:</td><td class="right"><input type="text" class="text" id="endDateCA" name="endDate"></td></tr>
<tr><td class="left">From:</td><td class="right">
<select id="fromCityCA" name="fromCity" onchange="document.getElementById('fromCityNameCA').value=this.options[this.selectedIndex].text">
    <option selected="selected" value="0">Select city</option>
    <option value="429">Beamsville, ON</option>
    <option value="438">Belleville, ON</option>
    <option value="277">Brockville, ON</option>
    <option value="273">Buffalo Airport, NY</option>
    <option value="95">Buffalo, NY</option>
    <option value="436">Burlington, ON</option>
    <option value="424">Cambridge, ON</option>
    <option value="278">Cornwall, ON</option>
    <option value="434">Fort Erie, ON</option>
    <option value="428">Grimsby, ON</option>
    <option value="426">Hamilton GO Centre, ON</option>
    <option value="425">Hamilton McMaster University, ON</option>
    <option value="276">Kingston, ON</option>
    <option value="279">Kirkland, PQ</option>
    <option value="423">Kitchener, ON</option>
    <option value="435">Mississauga, ON</option>
    <option value="280">Montreal, PQ</option>
    <option value="437">Napanee, ON</option>
    <option value="124">Niagara Falls, ON</option>
    <option value="449">Niagara Fallsview Casino, ON</option>
    <option value="431">Oakville, ON</option>
    <option value="433">Port Colborne, ON</option>
    <option value="441">Port Hope, ON</option>
    <option value="274">Scarborough, ON</option>
    <option value="427">St Catharines, ON</option>
    <option value="448">St. Catharines Brock University, ON</option>
    <option value="315">TC Kingston</option>
    <option value="310">Toronto Airport, ON</option>
    <option value="145">Toronto, ON</option>
    <option value="439">Trenton, ON</option>
    <option value="422">Waterloo, ON</option>
    <option value="432">Welland, ON</option>
    <option value="275">Whitby, ON</option>
</select></td></tr>
<tr><td class="left">To:</td><td class="right">
<select id="toCityCA" name="toCity" onchange="document.getElementById('toCityNameCA').value=this.options[this.selectedIndex].text">
<option selected="selected" value="0">Select city</option>
    <option value="429">Beamsville, ON</option>
    <option value="438">Belleville, ON</option>
    <option value="277">Brockville, ON</option>
    <option value="273">Buffalo Airport, NY</option>
    <option value="95">Buffalo, NY</option>
    <option value="436">Burlington, ON</option>
    <option value="424">Cambridge, ON</option>
    <option value="278">Cornwall, ON</option>
    <option value="434">Fort Erie, ON</option>
    <option value="428">Grimsby, ON</option>
    <option value="426">Hamilton GO Centre, ON</option>
    <option value="425">Hamilton McMaster University, ON</option>
    <option value="276">Kingston, ON</option>
    <option value="279">Kirkland, PQ</option>
    <option value="423">Kitchener, ON</option>
    <option value="435">Mississauga, ON</option>
    <option value="280">Montreal, PQ</option>
    <option value="437">Napanee, ON</option>
    <option value="124">Niagara Falls, ON</option>
    <option value="449">Niagara Fallsview Casino, ON</option>
    <option value="431">Oakville, ON</option>
    <option value="433">Port Colborne, ON</option>
    <option value="441">Port Hope, ON</option>
    <option value="274">Scarborough, ON</option>
    <option value="427">St Catharines, ON</option>
    <option value="448">St. Catharines Brock University, ON</option>
    <option value="315">TC Kingston</option>
    <option value="310">Toronto Airport, ON</option>
    <option value="145">Toronto, ON</option>
    <option value="439">Trenton, ON</option>
    <option value="422">Waterloo, ON</option>
    <option value="432">Welland, ON</option>
    <option value="275">Whitby, ON</option>
</select></td></tr>
<tr><td class="left">Promo Code:</td><td class="right"><input type="text" class="text" id="promoCodeCA" name="promoCode"></td></tr>
<tr><td><input type="image" src="btn_search.png"></td></tr>
<input type="hidden" id="fromCityNameCA" name="fromCityName">
<input type="hidden" id="toCityNameCA" name="toCityName">
</table>
</form>

<form action="usa.php" method="post">
<table class="country">
<tr><td><img src="usa.png" alt="US" height="25" width="50"></td></tr>
<tr><td class="left">Start Date:</td><td class="right"><input type="text" class="text" id="startDateUS" name="startDate"></td></tr>
<tr><td class="left">End Date:</td><td class="right"><input type="text" class="text" id="endDateUS" name="endDate"></td></tr>
<tr><td class="left">From:</td><td class="right">
<select id="fromCityUS" name="fromCity" onchange="document.getElementById('fromCityNameUS').value=this.options[this.selectedIndex].text">
    <option selected="selected" value="0">Select city</option>
    <option value="89">Albany, NY</option>
    <option value="90">Amherst, MA</option>
    <option value="91">Ann Arbor, MI</option>
    <option value="302">Athens, GA</option>
    <option value="289">Atlanta, GA</option>
    <option value="320">Austin, TX</option>
    <option value="143">Baltimore, MD</option>
    <option value="319">Baton Rouge, LA</option>
    <option value="93">Binghamton, NY</option>
    <option value="292">Birmingham, AL</option>
    <option value="94">Boston, MA</option>
    <option value="273">Buffalo Airport, NY</option>
    <option value="95">Buffalo, NY</option>
    <option value="420">Burbank, CA</option>
    <option value="96">Burlington, VT</option>
    <option value="99">Charlotte, NC</option>
    <option value="290">Chattanooga, TN</option>
    <option value="100">Chicago, IL</option>
    <option value="101">Christiansburg, VA</option>
    <option value="102">Cincinnati, OH</option>
    <option value="103">Cleveland, OH</option>
    <option value="104">Columbia, MO</option>
    <option value="454">Columbia, SC</option>
    <option value="105">Columbus, OH</option>
    <option value="317">Dallas/Fort Worth, TX</option>
    <option value="106">Des Moines, IA</option>
    <option value="107">Detroit, MI</option>
    <option value="131">Durham, NC</option>
    <option value="330">East Lansing, MI</option>
    <option value="108">Erie, PA</option>
    <option value="316">Fairhaven, MA</option>
    <option value="455">Fayetteville, NC</option>
    <option value="296">Gainesville, FL</option>
    <option value="331">Grand Rapids, MI</option>
    <option value="110">Hampton, VA</option>
    <option value="111">Harrisburg, PA</option>
    <option value="112">Hartford, CT</option>
    <option value="318">Houston, TX</option>
    <option value="115">Indianapolis, IN</option>
    <option value="116">Iowa City, IA</option>
    <option value="447">Jackson, MS</option>
    <option value="295">Jacksonville, FL</option>
    <option value="117">Kansas City, MO</option>
    <option value="118">Knoxville, TN</option>
    <option value="417">Las Vegas, NV</option>
    <option value="408">Lexington, KY</option>
    <option value="324">Little Rock, AR</option>
    <option value="390">Los Angeles, CA</option>
    <option value="298">Louisville, KY</option>
    <option value="300">Madison, U of Wisc, WI</option>
    <option value="119">Madison, WI</option>
    <option value="120">Memphis, TN</option>
    <option value="450">Miami, FL</option>
    <option value="121">Milwaukee, WI</option>
    <option value="144">Minneapolis, MN</option>
    <option value="294">Mobile, AL</option>
    <option value="293">Montgomery, AL</option>
    <option value="299">Morgantown, WV</option>
    <option value="291">Nashville, TN</option>
    <option value="305">New Brunswick, NJ</option>
    <option value="122">New Haven, CT</option>
    <option value="303">New Orleans, LA</option>
    <option value="123">New York, NY</option>
    <option value="389">Newark, DE</option>
    <option value="413">Oakland, CA</option>
    <option value="307">ODDyssey Hotel, PA</option>
    <option value="306">ODDyssey Race, PA</option>
    <option value="126">Omaha, NE</option>
    <option value="297">Orlando, FL</option>
    <option value="446">Oxford, MS</option>
    <option value="127">Philadelphia, PA</option>
    <option value="128">Pittsburgh, PA</option>
    <option value="129">Portland, ME</option>
    <option value="304">Princeton, NJ</option>
    <option value="130">Providence, RI</option>
    <option value="418">Reno, NV</option>
    <option value="132">Richmond, VA</option>
    <option value="133">Ridgewood, NJ</option>
    <option value="416">Riverside, CA</option>
    <option value="134">Rochester, NY</option>
    <option value="415">Sacramento, CA</option>
    <option value="321">San Antonio, TX</option>
    <option value="414">San Francisco, CA</option>
    <option value="412">San Jose, CA</option>
    <option value="301">Saratoga Springs, NY</option>
    <option value="135">Secaucus, NJ</option>
    <option value="419">Sparks, NV</option>
    <option value="136">St Louis, MO</option>
    <option value="430">St. Paul, MN</option>
    <option value="137">State College, PA</option>
    <option value="138">Storrs, CT</option>
    <option value="139">Syracuse, NY</option>
    <option value="453">Tallahassee, FL</option>
    <option value="451">Tampa, FL</option>
    <option value="140">Toledo, OH</option>
    <option value="145">Toronto, ON</option>
    <option value="142">Washington, DC</option>
</select></td></tr>
<tr><td class="left">To:</td><td class="right">
<select id="toCityUS" name="toCity" onchange="document.getElementById('toCityNameUS').value=this.options[this.selectedIndex].text">
    <option selected="selected" value="0">Select city</option>
    <option value="89">Albany, NY</option>
    <option value="90">Amherst, MA</option>
    <option value="91">Ann Arbor, MI</option>
    <option value="302">Athens, GA</option>
    <option value="289">Atlanta, GA</option>
    <option value="320">Austin, TX</option>
    <option value="143">Baltimore, MD</option>
    <option value="319">Baton Rouge, LA</option>
    <option value="93">Binghamton, NY</option>
    <option value="292">Birmingham, AL</option>
    <option value="94">Boston, MA</option>
    <option value="273">Buffalo Airport, NY</option>
    <option value="95">Buffalo, NY</option>
    <option value="420">Burbank, CA</option>
    <option value="96">Burlington, VT</option>
    <option value="99">Charlotte, NC</option>
    <option value="290">Chattanooga, TN</option>
    <option value="100">Chicago, IL</option>
    <option value="101">Christiansburg, VA</option>
    <option value="102">Cincinnati, OH</option>
    <option value="103">Cleveland, OH</option>
    <option value="104">Columbia, MO</option>
    <option value="454">Columbia, SC</option>
    <option value="105">Columbus, OH</option>
    <option value="317">Dallas/Fort Worth, TX</option>
    <option value="106">Des Moines, IA</option>
    <option value="107">Detroit, MI</option>
    <option value="131">Durham, NC</option>
    <option value="330">East Lansing, MI</option>
    <option value="108">Erie, PA</option>
    <option value="316">Fairhaven, MA</option>
    <option value="455">Fayetteville, NC</option>
    <option value="296">Gainesville, FL</option>
    <option value="331">Grand Rapids, MI</option>
    <option value="110">Hampton, VA</option>
    <option value="111">Harrisburg, PA</option>
    <option value="112">Hartford, CT</option>
    <option value="318">Houston, TX</option>
    <option value="115">Indianapolis, IN</option>
    <option value="116">Iowa City, IA</option>
    <option value="447">Jackson, MS</option>
    <option value="295">Jacksonville, FL</option>
    <option value="117">Kansas City, MO</option>
    <option value="118">Knoxville, TN</option>
    <option value="417">Las Vegas, NV</option>
    <option value="408">Lexington, KY</option>
    <option value="324">Little Rock, AR</option>
    <option value="390">Los Angeles, CA</option>
    <option value="298">Louisville, KY</option>
    <option value="300">Madison, U of Wisc, WI</option>
    <option value="119">Madison, WI</option>
    <option value="120">Memphis, TN</option>
    <option value="450">Miami, FL</option>
    <option value="121">Milwaukee, WI</option>
    <option value="144">Minneapolis, MN</option>
    <option value="294">Mobile, AL</option>
    <option value="293">Montgomery, AL</option>
    <option value="299">Morgantown, WV</option>
    <option value="291">Nashville, TN</option>
    <option value="305">New Brunswick, NJ</option>
    <option value="122">New Haven, CT</option>
    <option value="303">New Orleans, LA</option>
    <option value="123">New York, NY</option>
    <option value="389">Newark, DE</option>
    <option value="413">Oakland, CA</option>
    <option value="307">ODDyssey Hotel, PA</option>
    <option value="306">ODDyssey Race, PA</option>
    <option value="126">Omaha, NE</option>
    <option value="297">Orlando, FL</option>
    <option value="446">Oxford, MS</option>
    <option value="127">Philadelphia, PA</option>
    <option value="128">Pittsburgh, PA</option>
    <option value="129">Portland, ME</option>
    <option value="304">Princeton, NJ</option>
    <option value="130">Providence, RI</option>
    <option value="418">Reno, NV</option>
    <option value="132">Richmond, VA</option>
    <option value="133">Ridgewood, NJ</option>
    <option value="416">Riverside, CA</option>
    <option value="134">Rochester, NY</option>
    <option value="415">Sacramento, CA</option>
    <option value="321">San Antonio, TX</option>
    <option value="414">San Francisco, CA</option>
    <option value="412">San Jose, CA</option>
    <option value="301">Saratoga Springs, NY</option>
    <option value="135">Secaucus, NJ</option>
    <option value="419">Sparks, NV</option>
    <option value="136">St Louis, MO</option>
    <option value="430">St. Paul, MN</option>
    <option value="137">State College, PA</option>
    <option value="138">Storrs, CT</option>
    <option value="139">Syracuse, NY</option>
    <option value="453">Tallahassee, FL</option>
    <option value="451">Tampa, FL</option>
    <option value="140">Toledo, OH</option>
    <option value="145">Toronto, ON</option>
    <option value="142">Washington, DC</option>
</select></td></tr>
<tr><td class="left">Promo Code:</td><td class="right"><input type="text" class="text" id="promoCodeUS" name="promoCode"></td></tr>
<tr><td><input type="image" src="btn_search.png"></td></tr>
<input type="hidden" id="fromCityNameUS" name="fromCityName">
<input type="hidden" id="toCityNameUS" name="toCityName">
</table>
</form>

<a href="changelog.html">Changelog</a>
