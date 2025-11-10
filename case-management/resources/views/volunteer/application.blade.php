@extends('layouts.app')

@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
        <h4 class="font-bold">Please correct the following errors:</h4>
        <ul class="list-disc list-inside mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('title')
    - Volunteer Application
@endsection

@section('content')
    <div class="container mx-auto p-4">
    @section('header')
        Volunteer Application - Please complete the following information and we will be in touch soon.
    @endsection
    <div class="container">

        {{-- <div align="center" class="yellow-shade">
            <h3><a href="https://sfcms.net/solicitud">Para Español, Oprima aqui.</a></h3>
        </div> --}}

        {{-- <img src="https://sfcms.net/img/bannerlogo.png" width="100%" alt="Safe Families Logo"> --}}


        <form method="post" id="pdfform" action="/apply/index.php" class="form-horizontal" enctype="multipart/form-data">

            <div id="canapply">


                <div class="panel panel-info">
                    <div class="panel-heading">Personal Details</div>
                    <div class="panel-body">



                        <div class="row">
                            <div class="col-md-12">
                                <label>Please indicate the role(s) you would be interested in: <b>*</b></label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="checkbox"><label><input
                                            title="Host Family: Application, Background Checks for those 18+ in the home, 3 References, Training, Home Screening"
                                            type="checkbox" value="Y" id="HF_C" name="HF">Host
                                        Family</label></div>
                            </div>
                            <div class="col-md-3">
                                <div class="checkbox"><label><input
                                            title="Family Friend: Application, Background Check, 3 References, Training, Interview"
                                            type="checkbox" value="Y" id="FF_C" name="FF">Family
                                        Friend</label></div>
                            </div>
                            <div class="col-md-3">
                                <div class="checkbox"><label><input
                                            title="Family Coach: Application, Background Check, 3 References, Training, Interview"
                                            type="checkbox" value="Y" id="FC_C" name="FC">Family
                                        Coach</label></div>
                            </div>
                            <div class="col-md-3">
                                <div class="checkbox"><label><input title="Resource Friend: Application Only"
                                            type="checkbox" value="Y" id="RF_C" name="RF">Resource
                                        Friend</label></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="checkbox"><label><input title="Ministry Lead: Application Only"
                                            type="checkbox" value="Y" id="ML_C" name="ML">Ministry
                                        Lead</label></div>
                            </div>

                            <div class="col-md-6">
                                <div class="checkbox"><label><input type="checkbox" value="Y" id="JL_C"
                                            name="JL">Other</label> <i>* If you are unsure about what role to
                                        apply for, please contact <a href='https://safe-families.org/locations/'
                                            target='_blank'>the local chapter</a> for a conversation first.</i></div>
                            </div>

                            <div class="col-md-3" id="otherrole">
                                <label>Please specify</label><br>
                                <input type="text" name="otherrole" class="form-control" value="" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <p><i>Host Family:</i> Caring for children in your own home (overnight hosting or day
                                    time only care). <i><b><span
                                                title="Host Family: Application, Background Checks for those 18+ in the home, 3 References, Training, Home Screening">[requirements]</span></b></i>
                                </p>
                                <p><i>Family Friend:</i> Connect with either a parent (to provide friendship and
                                    support) or a child (mentorship or child care NOT in your own home), including
                                    transportation. <i><b><span
                                                title="Family Friend: Application, Background Check, 3 References, Training, Interview">[requirements]</span></b></i>
                                </p>
                                <p><i>Family Coach:</i> Come alongside families to help them reach their goals, monitor
                                    children in volunteer's homes, and support Host Families and Family Friends.
                                    <i><b><span
                                                title="Family Coach: Application, Background Check, 3 References, Training, Interview">[requirements]</span></b></i>
                                </p>
                                <p><i>Resource Friend:</i> Supporting families by providing useful goods or services.
                                    <i><b><span title="Resource Friend: Application Only">[requirements]</span></b></i>
                                </p>
                                <p><i>Ministry Lead:</i> Representing the work of Saf Families in your church(es).</p>
                                <p><i>Other:</i> Including financial donations, admin work, advocating, prayer or any
                                    other way of being connected to the movement not already listed.</p>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-3">
                                <label>Title</label><br>
                                <select name="lmtitle" class="form-control">
                                    <option value=""></option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Ms">Ms</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Prof">Prof</option>
                                    <option value="Rev">Rev</option>
                                    <option value="Sir">Sir</option>
                                    <option value="Dr">Dr</option>
                                    <option value="Pastor">Pastor</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>First name <b>*</b></label><br>
                                <input type="text" name="lmfirstname" class="form-control" value="" />
                            </div>
                            <div class="col-md-3">
                                <label>Last name <b>*</b></label><br>
                                <input type="text" name="lmsurname" class="form-control" value="" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label>Date of Birth <b>*</b></label><br>
                                <select name="lmdobmnth" class="form-control form-control-inline">
                                    <option value=""></option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>

                                <select name="lmdobday" class="form-control form-control-inline">
                                    <option value=""></option>
                                    <option value="1">1st</option>
                                    <option value="2">2nd</option>
                                    <option value="3">3rd</option>
                                    <option value="4">4th</option>
                                    <option value="5">5th</option>
                                    <option value="6">6th</option>
                                    <option value="7">7th</option>
                                    <option value="8">8th</option>
                                    <option value="9">9th</option>
                                    <option value="10">10th</option>
                                    <option value="11">11th</option>
                                    <option value="12">12th</option>
                                    <option value="13">13th</option>
                                    <option value="14">14th</option>
                                    <option value="15">15th</option>
                                    <option value="16">16th</option>
                                    <option value="17">17th</option>
                                    <option value="18">18th</option>
                                    <option value="19">19th</option>
                                    <option value="20">20th</option>
                                    <option value="21">21st</option>
                                    <option value="22">22nd</option>
                                    <option value="23">23rd</option>
                                    <option value="24">24th</option>
                                    <option value="25">25th</option>
                                    <option value="26">26th</option>
                                    <option value="27">27th</option>
                                    <option value="28">28th</option>
                                    <option value="29">29th</option>
                                    <option value="30">30th</option>
                                    <option value="31">31st</option>
                                </select>

                                <select name="lmdobyear" class="form-control form-control-inline">
                                    <option value=""></option>

                                    <option value='2025'>2025</option>
                                    <option value='2024'>2024</option>
                                    <option value='2023'>2023</option>
                                    <option value='2022'>2022</option>
                                    <option value='2021'>2021</option>
                                    <option value='2020'>2020</option>
                                    <option value='2019'>2019</option>
                                    <option value='2018'>2018</option>
                                    <option value='2017'>2017</option>
                                    <option value='2016'>2016</option>
                                    <option value='2015'>2015</option>
                                    <option value='2014'>2014</option>
                                    <option value='2013'>2013</option>
                                    <option value='2012'>2012</option>
                                    <option value='2011'>2011</option>
                                    <option value='2010'>2010</option>
                                    <option value='2009'>2009</option>
                                    <option value='2008'>2008</option>
                                    <option value='2007'>2007</option>
                                    <option value='2006'>2006</option>
                                    <option value='2005'>2005</option>
                                    <option value='2004'>2004</option>
                                    <option value='2003'>2003</option>
                                    <option value='2002'>2002</option>
                                    <option value='2001'>2001</option>
                                    <option value='2000'>2000</option>
                                    <option value='1999'>1999</option>
                                    <option value='1998'>1998</option>
                                    <option value='1997'>1997</option>
                                    <option value='1996'>1996</option>
                                    <option value='1995'>1995</option>
                                    <option value='1994'>1994</option>
                                    <option value='1993'>1993</option>
                                    <option value='1992'>1992</option>
                                    <option value='1991'>1991</option>
                                    <option value='1990'>1990</option>
                                    <option value='1989'>1989</option>
                                    <option value='1988'>1988</option>
                                    <option value='1987'>1987</option>
                                    <option value='1986'>1986</option>
                                    <option value='1985'>1985</option>
                                    <option value='1984'>1984</option>
                                    <option value='1983'>1983</option>
                                    <option value='1982'>1982</option>
                                    <option value='1981'>1981</option>
                                    <option value='1980'>1980</option>
                                    <option value='1979'>1979</option>
                                    <option value='1978'>1978</option>
                                    <option value='1977'>1977</option>
                                    <option value='1976'>1976</option>
                                    <option value='1975'>1975</option>
                                    <option value='1974'>1974</option>
                                    <option value='1973'>1973</option>
                                    <option value='1972'>1972</option>
                                    <option value='1971'>1971</option>
                                    <option value='1970'>1970</option>
                                    <option value='1969'>1969</option>
                                    <option value='1968'>1968</option>
                                    <option value='1967'>1967</option>
                                    <option value='1966'>1966</option>
                                    <option value='1965'>1965</option>
                                    <option value='1964'>1964</option>
                                    <option value='1963'>1963</option>
                                    <option value='1962'>1962</option>
                                    <option value='1961'>1961</option>
                                    <option value='1960'>1960</option>
                                    <option value='1959'>1959</option>
                                    <option value='1958'>1958</option>
                                    <option value='1957'>1957</option>
                                    <option value='1956'>1956</option>
                                    <option value='1955'>1955</option>
                                    <option value='1954'>1954</option>
                                    <option value='1953'>1953</option>
                                    <option value='1952'>1952</option>
                                    <option value='1951'>1951</option>
                                    <option value='1950'>1950</option>
                                    <option value='1949'>1949</option>
                                    <option value='1948'>1948</option>
                                    <option value='1947'>1947</option>
                                    <option value='1946'>1946</option>
                                    <option value='1945'>1945</option>
                                    <option value='1944'>1944</option>
                                    <option value='1943'>1943</option>
                                    <option value='1942'>1942</option>
                                    <option value='1941'>1941</option>
                                    <option value='1940'>1940</option>
                                    <option value='1939'>1939</option>
                                    <option value='1938'>1938</option>
                                    <option value='1937'>1937</option>
                                    <option value='1936'>1936</option>
                                    <option value='1935'>1935</option>
                                    <option value='1934'>1934</option>
                                    <option value='1933'>1933</option>
                                    <option value='1932'>1932</option>
                                    <option value='1931'>1931</option>
                                    <option value='1930'>1930</option>
                                    <option value='1929'>1929</option>
                                    <option value='1928'>1928</option>
                                    <option value='1927'>1927</option>
                                    <option value='1926'>1926</option>
                                    <option value='1925'>1925</option>
                                    <option value='1924'>1924</option>
                                    <option value='1923'>1923</option>
                                    <option value='1922'>1922</option>
                                    <option value='1921'>1921</option>
                                    <option value='1920'>1920</option>
                                    <option value='1919'>1919</option>
                                    <option value='1918'>1918</option>
                                    <option value='1917'>1917</option>
                                    <option value='1916'>1916</option>
                                    <option value='1915'>1915</option>
                                    <option value='1914'>1914</option>
                                    <option value='1913'>1913</option>
                                    <option value='1912'>1912</option>
                                    <option value='1911'>1911</option>
                                    <option value='1910'>1910</option>
                                    <option value='1909'>1909</option>
                                    <option value='1908'>1908</option>
                                    <option value='1907'>1907</option>
                                    <option value='1906'>1906</option>
                                    <option value='1905'>1905</option>
                                    <option value='1904'>1904</option>
                                    <option value='1903'>1903</option>
                                    <option value='1902'>1902</option>
                                    <option value='1901'>1901</option>

                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Email Address <b>*</b></label><br>
                                <input type="text" name="lmemail" class="form-control" value="" />
                            </div>
                            <div class="col-md-4">
                                <label>Phone Number <b>*</b></label><br>
                                <input type="text" name="lmtelephone" class="form-control" value="" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label>Preferred Method of Contact <b>*</b></label><br>
                                <select name="lmmethod" class="form-control form-control-inline">
                                    <option value=""></option>
                                    <option value='Email'>Email</option>
                                    <option value='Phone'>Phone</option>
                                </select>
                            </div>
                        </div>

                        <div id="notresource">

                            <div class="row">

                                <div class="col-md-4">
                                    <label>Gender <b>*</b></label><br>
                                    <select name="lmgender" class="form-control">
                                        <option value="Not Supplied"></option>
                                        <option value="Female">Female</option>
                                        <option value="Male">Male</option>
                                        <!-- <option value="Other">Other</option> -->
                                        <option value="Not Supplied">Prefer Not To Say</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label>Ethnicity <b>*</b></label><br>
                                    <select name="lmethnicity" class="form-control">
                                        <option value="Not Supplied"></option>

                                        <option value='8'>American Indian/Alaskan Native</option>
                                        <option value='3'>Asian</option>
                                        <option value='2'>Black or African American</option>
                                        <option value='4'>Caucasian/White</option>
                                        <option value='5'>Hispanic/Latino</option>
                                        <option value='6'>Middle Eastern</option>
                                        <option value='12'>Native Hawaiian/Other Pacific Islander</option>
                                        <option value='9'>Prefer not to answer</option>
                                        <option value='7'>Two or more races</option>

                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label>Religion</label><br>
                                    <input type="text" name="lmreligion" class="form-control" value="" />
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <label>Languages Spoken</label><br>
                                    <input type="text" name="lmlanguages" class="form-control" value="" />
                                </div>

                            </div>

                        </div>

                        <hr size="1">



                        <div class="row">
                            <div class="col-md-6">
                                <label>Street Address and Apartment Number: <b>*</b></label><br>
                                <input type="text" name="street" value="" class="form-control" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <label>Town/City: <b>*</b></label><br>
                                <input type="text" name="city" value="" class="form-control" />
                            </div>
                            <div class="col-md-3">
                                <label>County: <b>*</b></label><br>
                                <input type="text" name="county" value="" class="form-control" />
                            </div>
                            <div class="col-md-3">
                                <label>State: <b>*</b></label><br>
                                <input type="text" name="state" value="" class="form-control" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <label>ZIP Code: <b>*</b></label><br>
                                <input type="text" name="postcode" value="" class="form-control" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label>Your Church <b>*</b></label> <i>(if you don't have one then please enter
                                    "N/A")</i>:</label><br>
                                <input type="text" name="church" class="form-control" value="" />
                            </div>
                            <div class="col-md-4">
                                <label>How Did You Hear About Safe Families for Children:</label><br>
                                <select name="howhear" class="form-control">
                                    <option value=""></option>
                                    <option value="Church Presentation">Church Presentation</option>
                                    <option value="Word of Mouth">Word of Mouth</option>
                                    <option value="Safe Families Staff">Safe Families Staff</option>
                                    <option value="Safe Families Website">Safe Families Website</option>
                                    <option value="Other Website">Other Website</option>
                                    <option value="Facebook">Facebook</option>
                                    <option value="Twitter">Twitter</option>
                                    <option value="Google Search">Google Search</option>
                                    <option value="LinkedIn">LinkedIn</option>
                                    <option value="Flyer/Leaflet">Flyer/Leaflet</option>
                                    <option value="Radio">Radio</option>
                                    <option value="TV">TV</option>
                                    <option value="Festival/Event">Festival/Event</option>
                                </select>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-4">
                                <label>May we communicate with you via email and text?</label> * <small>By answering yes
                                    you will be added to the local newsletter and start receiving any local resource
                                    requests.</small><br>
                                <select name="enews" class="form-control">
                                    <option value=""></option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                            </div>
                        </div>

                        <hr size="1">

                        <div id="notresource2">


                            <div class="row">
                                <div class="col-md-4">
                                    <label>Does anyone else live in your household?</label> *<br>
                                    <select name="anyone" id="anyone" class="form-control">
                                        <option value=""></option>
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>
                                    </select>
                                </div>
                            </div>

                            <div id="othmembers">

                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Please add any members of your household:</label> *all family members
                                        must be listed for Host Families*<br>
                                    </div>
                                </div>




                                <div class="edu_itemRows">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Title</label><br>
                                            <select name="othtitle[]" class="form-control">
                                                <option value=""></option>
                                                <option value="Mr">Mr</option>
                                                <option value="Mrs">Mrs</option>
                                                <option value="Ms">Ms</option>
                                                <option value="Miss">Miss</option>
                                                <option value="Prof">Prof</option>
                                                <option value="Rev">Rev</option>
                                                <option value="Sir">Sir</option>
                                                <option value="Dr">Dr</option>
                                                <option value="Pastor">Pastor</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>First name <b>*</b></label><br>
                                            <input type="text" name="othfirstname[]" class="form-control"
                                                value="" />
                                        </div>
                                        <div class="col-md-3">
                                            <label>Last name <b>*</b></label><br>
                                            <input type="text" name="othsurname[]" class="form-control"
                                                value="" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Date of Birth <b>*</b></label><br>
                                            <select name="othdobmnth[]" class="form-control form-control-inline">
                                                <option value=""></option>
                                                <option value="1">January</option>
                                                <option value="2">February</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                                <option value="7">July</option>
                                                <option value="8">August</option>
                                                <option value="9">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>

                                            <select name="othdobday[]" class="form-control form-control-inline">
                                                <option value=""></option>
                                                <option value="1">1st</option>
                                                <option value="2">2nd</option>
                                                <option value="3">3rd</option>
                                                <option value="4">4th</option>
                                                <option value="5">5th</option>
                                                <option value="6">6th</option>
                                                <option value="7">7th</option>
                                                <option value="8">8th</option>
                                                <option value="9">9th</option>
                                                <option value="10">10th</option>
                                                <option value="11">11th</option>
                                                <option value="12">12th</option>
                                                <option value="13">13th</option>
                                                <option value="14">14th</option>
                                                <option value="15">15th</option>
                                                <option value="16">16th</option>
                                                <option value="17">17th</option>
                                                <option value="18">18th</option>
                                                <option value="19">19th</option>
                                                <option value="20">20th</option>
                                                <option value="21">21st</option>
                                                <option value="22">22nd</option>
                                                <option value="23">23rd</option>
                                                <option value="24">24th</option>
                                                <option value="25">25th</option>
                                                <option value="26">26th</option>
                                                <option value="27">27th</option>
                                                <option value="28">28th</option>
                                                <option value="29">29th</option>
                                                <option value="30">30th</option>
                                                <option value="31">31st</option>
                                            </select>

                                            <select name="othdobyear[]" class="form-control form-control-inline">
                                                <option value=""></option>

                                                <option value='2025'>2025</option>
                                                <option value='2024'>2024</option>
                                                <option value='2023'>2023</option>
                                                <option value='2022'>2022</option>
                                                <option value='2021'>2021</option>
                                                <option value='2020'>2020</option>
                                                <option value='2019'>2019</option>
                                                <option value='2018'>2018</option>
                                                <option value='2017'>2017</option>
                                                <option value='2016'>2016</option>
                                                <option value='2015'>2015</option>
                                                <option value='2014'>2014</option>
                                                <option value='2013'>2013</option>
                                                <option value='2012'>2012</option>
                                                <option value='2011'>2011</option>
                                                <option value='2010'>2010</option>
                                                <option value='2009'>2009</option>
                                                <option value='2008'>2008</option>
                                                <option value='2007'>2007</option>
                                                <option value='2006'>2006</option>
                                                <option value='2005'>2005</option>
                                                <option value='2004'>2004</option>
                                                <option value='2003'>2003</option>
                                                <option value='2002'>2002</option>
                                                <option value='2001'>2001</option>
                                                <option value='2000'>2000</option>
                                                <option value='1999'>1999</option>
                                                <option value='1998'>1998</option>
                                                <option value='1997'>1997</option>
                                                <option value='1996'>1996</option>
                                                <option value='1995'>1995</option>
                                                <option value='1994'>1994</option>
                                                <option value='1993'>1993</option>
                                                <option value='1992'>1992</option>
                                                <option value='1991'>1991</option>
                                                <option value='1990'>1990</option>
                                                <option value='1989'>1989</option>
                                                <option value='1988'>1988</option>
                                                <option value='1987'>1987</option>
                                                <option value='1986'>1986</option>
                                                <option value='1985'>1985</option>
                                                <option value='1984'>1984</option>
                                                <option value='1983'>1983</option>
                                                <option value='1982'>1982</option>
                                                <option value='1981'>1981</option>
                                                <option value='1980'>1980</option>
                                                <option value='1979'>1979</option>
                                                <option value='1978'>1978</option>
                                                <option value='1977'>1977</option>
                                                <option value='1976'>1976</option>
                                                <option value='1975'>1975</option>
                                                <option value='1974'>1974</option>
                                                <option value='1973'>1973</option>
                                                <option value='1972'>1972</option>
                                                <option value='1971'>1971</option>
                                                <option value='1970'>1970</option>
                                                <option value='1969'>1969</option>
                                                <option value='1968'>1968</option>
                                                <option value='1967'>1967</option>
                                                <option value='1966'>1966</option>
                                                <option value='1965'>1965</option>
                                                <option value='1964'>1964</option>
                                                <option value='1963'>1963</option>
                                                <option value='1962'>1962</option>
                                                <option value='1961'>1961</option>
                                                <option value='1960'>1960</option>
                                                <option value='1959'>1959</option>
                                                <option value='1958'>1958</option>
                                                <option value='1957'>1957</option>
                                                <option value='1956'>1956</option>
                                                <option value='1955'>1955</option>
                                                <option value='1954'>1954</option>
                                                <option value='1953'>1953</option>
                                                <option value='1952'>1952</option>
                                                <option value='1951'>1951</option>
                                                <option value='1950'>1950</option>
                                                <option value='1949'>1949</option>
                                                <option value='1948'>1948</option>
                                                <option value='1947'>1947</option>
                                                <option value='1946'>1946</option>
                                                <option value='1945'>1945</option>
                                                <option value='1944'>1944</option>
                                                <option value='1943'>1943</option>
                                                <option value='1942'>1942</option>
                                                <option value='1941'>1941</option>
                                                <option value='1940'>1940</option>
                                                <option value='1939'>1939</option>
                                                <option value='1938'>1938</option>
                                                <option value='1937'>1937</option>
                                                <option value='1936'>1936</option>
                                                <option value='1935'>1935</option>
                                                <option value='1934'>1934</option>
                                                <option value='1933'>1933</option>
                                                <option value='1932'>1932</option>
                                                <option value='1931'>1931</option>
                                                <option value='1930'>1930</option>
                                                <option value='1929'>1929</option>
                                                <option value='1928'>1928</option>
                                                <option value='1927'>1927</option>
                                                <option value='1926'>1926</option>
                                                <option value='1925'>1925</option>
                                                <option value='1924'>1924</option>
                                                <option value='1923'>1923</option>
                                                <option value='1922'>1922</option>
                                                <option value='1921'>1921</option>
                                                <option value='1920'>1920</option>
                                                <option value='1919'>1919</option>
                                                <option value='1918'>1918</option>
                                                <option value='1917'>1917</option>
                                                <option value='1916'>1916</option>
                                                <option value='1915'>1915</option>
                                                <option value='1914'>1914</option>
                                                <option value='1913'>1913</option>
                                                <option value='1912'>1912</option>
                                                <option value='1911'>1911</option>
                                                <option value='1910'>1910</option>
                                                <option value='1909'>1909</option>
                                                <option value='1908'>1908</option>
                                                <option value='1907'>1907</option>
                                                <option value='1906'>1906</option>
                                                <option value='1905'>1905</option>
                                                <option value='1904'>1904</option>
                                                <option value='1903'>1903</option>
                                                <option value='1902'>1902</option>
                                                <option value='1901'>1901</option>

                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Email Address (<i>if applicable</i>)</label><br>
                                            <input type="text" name="othemail[]" class="form-control"
                                                value="" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Phone Number (<i>if applicable</i>)</label><br>
                                            <input type="text" name="othtelephone[]" class="form-control"
                                                value="" />
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-3">
                                            <label>Gender <b>*</b></label><br>
                                            <select name="othgender[]" class="form-control">
                                                <option value="Not Supplied"></option>
                                                <option value="Female">Female</option>
                                                <option value="Male">Male</option>
                                                <!-- <option value="Other">Other</option> -->
                                                <option value="Not Supplied">Prefer Not To Say</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label>Ethnicity <b>*</b></label><br>
                                            <select name="othethnicity[]" class="form-control">
                                                <option value="Not Supplied"></option>

                                                <option value='8'>American Indian/Alaskan Native</option>
                                                <option value='3'>Asian</option>
                                                <option value='2'>Black or African American</option>
                                                <option value='4'>Caucasian/White</option>
                                                <option value='5'>Hispanic/Latino</option>
                                                <option value='6'>Middle Eastern</option>
                                                <option value='12'>Native Hawaiian/Other Pacific Islander</option>
                                                <option value='9'>Prefer not to answer</option>
                                                <option value='7'>Two or more races</option>

                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label>Religion</label><br>
                                            <input type="text" name="othreligion[]" class="form-control"
                                                value="" />
                                        </div>

                                        <div class="col-md-3">
                                            <label>Relationship to you <b>*</b></label><br>
                                            <select name="othrelationship[]" class="form-control">
                                                <option value="Not Supplied"></option>

                                                <option value='18'>Aunt</option>
                                                <option value='28'>Child</option>
                                                <option value='7'>Daughter</option>
                                                <option value='23'>Father</option>
                                                <option value='13'>Granddaughter</option>
                                                <option value='17'>Grandfather</option>
                                                <option value='16'>Grandmother</option>
                                                <option value='12'>Grandson</option>
                                                <option value='26'>Great-Granddaughter</option>
                                                <option value='25'>Great-Grandson</option>
                                                <option value='2'>Husband</option>
                                                <option value='15'>Legal Guardian</option>
                                                <option value='1'>Mother</option>
                                                <option value='11'>Nephew</option>
                                                <option value='10'>Niece</option>
                                                <option value='20'>No Biological Relation</option>
                                                <option value='4'>Partner</option>
                                                <option value='24'>Sibling</option>
                                                <option value='6'>Son</option>
                                                <option value='9'>Step-Daughter</option>
                                                <option value='5'>Step-Father</option>
                                                <option value='14'>Step-Mother</option>
                                                <option value='8'>Step-Son</option>
                                                <option value='19'>Uncle</option>
                                                <option value='27'>Unknown</option>
                                                <option value='3'>Wife</option>

                                            </select>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>If over 18 years of age, does this person want to volunteer?
                                                <b>*</b></label> <i>All applicants applying to be a host family must say
                                                yes to a spouse or partner volunteering as they will be involved in the
                                                hosting</i><br>
                                            <select name="othvol[]" class="form-control form-control-inline">
                                                <option value=""></option>
                                                <option value="Nt">Not over 18</option>
                                                <option value="N">No</option>
                                                <option value="Y">Yes</option>
                                            </select>
                                        </div>

                                    </div>

                                    <hr size="1" id="foot_1" class="footer">

                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="button" value="Add additional household member"
                                            id="edu_butadd" /><br>
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function() {

                                        $('#edu_butadd').click(function() {

                                            // Create clone of <div class='input-form'>
                                            var newel = $('.edu_itemRows:last').clone(false);

                                            // Add after last <div class='input-form'>
                                            $(newel).insertAfter('.edu_itemRows:last').find("input[type='text'], textarea").val("");
                                        });

                                    });
                                </script>


                                <!--**********-->


                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>Please describe any life experiences, skills, interests, volunteer work, and
                                        professional expertise that you have: <b>*</b></label><br>
                                    <textarea name="volsummary" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>Please let us know how you would like to utilize or share any of the above
                                        skills/expertise within your Safe Families for Children volunteer role; either
                                        with parents children and/or the organization: <b>*</b></label><br>
                                    <textarea name="volsummary2" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>Please share your motivation for wanting to volunteer with Safe Families for
                                        Children: <b>*</b></label><br>
                                    <textarea name="volsummary3" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <p>The following questions are required so that there can be a more thorough
                                        discussion at the interview regarding if they would impact your ability to
                                        volunteer. They do not automatically disqualify you.</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>Have you or someone in your home ever had a substance abuse or alcohol
                                        problem? <b>*</b></label><br>
                                    <select name="ref7" class="form-control" id="ref7">
                                        <option value=""></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row" id="ref7d">
                                <div class="col-md-6">
                                    <label>Please add details <b>*</b></label><br>
                                    <input type="text" name="ref7d" class="form-control" value="" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>Are you currently receiving treatment for a mental or physical health
                                        condition that may impact your ability to care for children? if so, please
                                        explain further and we will follow-up with you <b>*</b></label><br>
                                    <select name="ref8" class="form-control" id="ref8">
                                        <option value=""></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row" id="ref8d">
                                <div class="col-md-6">
                                    <label>Please add details <b>*</b></label><br>
                                    <input type="text" name="ref8d" class="form-control" value="" />
                                </div>
                            </div>

                            <!--
<div class="row">
<div class="col-md-12">
<label>Do you have any health concerns that might impact your ability to volunteer? <b>*</b></label><br>
<select name="ref9" class="form-control" id="ref9">
<option value=""></option>
<option value="Yes"<br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined variable: ref9 in C:\wamp\www\sfcms_net\apply\index.php on line <i>2307</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.0034</td><td bgcolor='#eeeeec' align='right'>970024</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='C:\wamp\www\sfcms_net\apply\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>0</td></tr>
</table></font>
>Yes</option>
<option value="No"<br />
<font size='1'><table class='xdebug-error xe-notice' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
<tr><th align='left' bgcolor='#f57900' colspan="5"><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Notice: Undefined variable: ref9 in C:\wamp\www\sfcms_net\apply\index.php on line <i>2308</i></th></tr>
<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th></tr>
<tr><th align='center' bgcolor='#eeeeec'>#</th><th align='left' bgcolor='#eeeeec'>Time</th><th align='left' bgcolor='#eeeeec'>Memory</th><th align='left' bgcolor='#eeeeec'>Function</th><th align='left' bgcolor='#eeeeec'>Location</th></tr>
<tr><td bgcolor='#eeeeec' align='center'>1</td><td bgcolor='#eeeeec' align='center'>0.0034</td><td bgcolor='#eeeeec' align='right'>970024</td><td bgcolor='#eeeeec'>{main}(  )</td><td title='C:\wamp\www\sfcms_net\apply\index.php' bgcolor='#eeeeec'>..\index.php<b>:</b>0</td></tr>
</table></font>
>No</option>
</select>
</div>
</div>
-->

                        </div>

                    </div>
                </div>

                <!-- REFERENCES PANEL -->

                <div id="Ref_Panel">
                    <div class="panel panel-info">
                        <div class="panel-heading">Your References</div>
                        <div class="panel-body">


                            <div class="row">
                                <div class="col-md-12">
                                    <p>References are required for Host families, Family friends, and Family coaches.
                                    </p>
                                    <p>Any couples/roommates applying need 3 references that speak to BOTH applicants.
                                        If references only know one applicant, you must add additional references when
                                        filling out a spouse/partner/roommates application.</p>
                                    <p><b>Each reference should have known you for at least 2 years and not be members
                                            of your family.</b> We cannot accept more than two references who know you
                                        from one place i.e. church.</p>
                                    <p>Please enter a first name, last name, a telephone number and email address.
                                        Please choose references who know all applicants in the family.</p>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    Reference 1's Details <b>(Church Leader, Community Leader, or Mentor) <b>*</b></b>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label>First name</label><br>
                                    <input type="text" name="r1_firstname" class="form-control" value="" />
                                </div>
                                <div class="col-md-2">
                                    <label>Last name</label><br>
                                    <input type="text" name="r1_surname" class="form-control" value="" />
                                </div>
                                <div class="col-md-3">
                                    <label>Relationship to You</label><br>
                                    <input type="text" name="r1_rel" class="form-control" value="" />
                                </div>
                                <div class="col-md-3">
                                    <label>Email Address</label><br>
                                    <input type="text" name="r1_email" class="form-control" value="" />
                                </div>
                                <div class="col-md-2">
                                    <label>Contact Number</label><br>
                                    <input type="text" name="r1_telephone" class="form-control" value="" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    Reference 2's Details <b>(Employer/Supervisor/Leader/Co-worker) <b>*</b></b>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label>First name</label><br>
                                    <input type="text" name="r2_firstname" class="form-control" value="" />
                                </div>
                                <div class="col-md-2">
                                    <label>Last name</label><br>
                                    <input type="text" name="r2_surname" class="form-control" value="" />
                                </div>
                                <div class="col-md-3">
                                    <label>Relationship to You</label><br>
                                    <input type="text" name="r2_rel" class="form-control" value="" />
                                </div>
                                <div class="col-md-3">
                                    <label>Email Address</label><br>
                                    <input type="text" name="r2_email" class="form-control" value="" />
                                </div>
                                <div class="col-md-2">
                                    <label>Contact Number</label><br>
                                    <input type="text" name="r2_telephone" class="form-control" value="" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    Reference 3's Details <b>(Friend) <b>*</b></b>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label>First name</label><br>
                                    <input type="text" name="r3_firstname" class="form-control" value="" />
                                </div>
                                <div class="col-md-2">
                                    <label>Last name</label><br>
                                    <input type="text" name="r3_surname" class="form-control" value="" />
                                </div>
                                <div class="col-md-3">
                                    <label>Relationship to You</label><br>
                                    <input type="text" name="r3_rel" class="form-control" value="" />
                                </div>
                                <div class="col-md-3">
                                    <label>Email Address</label><br>
                                    <input type="text" name="r3_email" class="form-control" value="" />
                                </div>
                                <div class="col-md-2">
                                    <label>Contact Number</label><br>
                                    <input type="text" name="r3_telephone" class="form-control" value="" />
                                </div>
                            </div>

                            <hr size="1">


                            <div class="row">
                                <div class="col-md-12">
                                    <label>I confirm that these individuals can each be contacted on my suitability for
                                        this role. <b>*</b></label><br>
                                    <select name="ref1" class="form-control">
                                        <option value=""></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>I confirm that these individuals are independent from one another.
                                        <b>*</b></label><br>
                                    <select name="ref2" class="form-control">
                                        <option value=""></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>I confirm that not all three people work closely together.
                                        <b>*</b></label><br>
                                    <select name="ref3" class="form-control">
                                        <option value=""></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>I confirm these references are not known to be related to me.
                                        <b>*</b></label><br>
                                    <select name="ref4" class="form-control">
                                        <option value=""></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- END REFERENCES PANEL -->




                <!-- DRIVE PANEL -->

                <div id="Drive_Panel">
                    <div class="panel panel-info">
                        <div class="panel-heading">Your Driving Details</div>
                        <div class="panel-body">



                            <div class="row">
                                <div class="col-md-6">
                                    <label><b>Please select one of the following: *</b></label><br>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkbox"><label><input type="radio" value="may_drive"
                                                id="may_drive" name="drive">I am willing to drive individuals or
                                            families while serving with Safe Families for Children if the need
                                            arises.</label></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkbox"><label><input type="radio" value="no_drive"
                                                id="no_drive" name="drive">I will NOT be providing transportation
                                            while serving with Safe Families for Children.</label></div>
                                </div>
                            </div>

                            <div id="no_driving">

                                <b>
                                    <font color="#FF0000"></font>
                                </b>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Please check all that apply:</label><br>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="checkbox"><label><input type="checkbox" value="Y"
                                                    id="license" name="license">I do not have a valid driver’s
                                                license</label></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="checkbox"><label><input type="checkbox" value="Y"
                                                    id="access" name="access">I do not own or have access to a
                                                vehicle</label></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="checkbox"><label><input type="checkbox" value="Y"
                                                    id="comfort" name="comfort">I am not comfortable driving as a
                                                Safe Families volunteer</label></div>
                                    </div>
                                </div>

                            </div>

                            <div id="yes_driving">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Required Information (for volunteers providing
                                            transportation)</label><br>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label><b>Driver's License Number *</b></label><br><input type="text"
                                            id="license_number" name="license_number" value="">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6">
                                        <label><b>State of Issuance *</b></label><br><input type="text"
                                            id="state_issuance" name="state_issuance" value="">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6">
                                        <label><b>License Expiration Date *</b></label><br><input type="date"
                                            class="form-control" id="date" name="expiry" value="">
                                    </div>
                                </div>



                                <b>
                                    <font color="#FF0000"></font>
                                </b>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label><b>Upload a clear photo of the front of your valid driver’s license
                                                *</b></label><br><input name="license_photo" type="file" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label><b>Insurance Expiration Date *</b></label><br><input type="date"
                                            class="form-control" id="date" name="insexpiry" value="">
                                    </div>
                                </div>

                                <b>
                                    <font color="#FF0000"></font>
                                </b>


                                <div class="row">
                                    <div class="col-md-6">
                                        <label><b>Upload a current copy/photo of your auto insurance card (showing
                                                coverage dates) *</b></label><br><input name="auto_insurance"
                                            type="file" />
                                    </div>
                                </div>





                                <div class="row">
                                    <div class="col-md-6">
                                        <label><b>Consent and Acknowledgement</b></label><br>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="checkbox"><label><input type="checkbox" value="Y"
                                                    id="certify" name="certify">I certify that I possess a valid
                                                driver’s license and maintain current auto liability insurance in
                                                compliance with state laws.</label></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="checkbox"><label><input type="checkbox" value="Y"
                                                    id="share" name="share">I give permission for Safe
                                                Families for Children to share my driving and insurance information with
                                                its insurance provider, if necessary, to secure secondary coverage
                                                related to my volunteer role.</label></div>
                                    </div>
                                </div>

                            </div>

                            <div id="no_driving_consent">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label><b>I understand and agree that:</b></label><br>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="checkbox"><label><input type="checkbox" value="Y"
                                                    id="understand" name="understand">I am not permitted to
                                                transport any individual I support through Safe Families for
                                                Children.</label></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="checkbox"><label><input type="checkbox" value="Y"
                                                    id="contact" name="contact">If my circumstances change and I
                                                wish to provide transportation, I must contact SFFC staff and complete
                                                this form with my updated information and documentation.</label></div>
                                    </div>
                                </div>

                            </div>

                            <div id="all_driving">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label><b>Initial to acknowledge *</b></label><br><input type="text"
                                            id="initial" name="initial" value="">
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>

                    <!-- END DRIVE PANEL -->
                </div>








                <div class="panel panel-info">
                    <div class="panel-heading">Background Information</div>
                    <div class="panel-body">


                        <div id="notresource3">

                            <div class="row">
                                <div class="col-md-12">
                                    <label>Have you ever been charged or convicted of any criminal offense?
                                        <b>*</b></label><br>
                                    <select name="ref5" class="form-control" id="ref5">
                                        <option value=""></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>Have you ever been involved with a child abuse/neglect investigation?
                                        <b>*</b></label><br>
                                    <select name="ref6" class="form-control" id="ref6">
                                        <option value=""></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <i>Historic and/or current offenses may or may not have a bearing upon the
                                        application depending on the category, date and mitigating circumstances.</i>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <p>This volunteer position requires a background check and fingerprinting, as well
                                        as an interview.</p>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <p>I declare that the information given here is correct to the best of my knowledge and
                                    understand that the withholding of relevant information or the giving of inaccurate
                                    information may jeopardize my application.</p>
                                <div class="yellow-shade">
                                    <p>
                                    <div class="checkbox"><label><input type="checkbox" value="Y"
                                                id="declaration" name="declaration"><b>Please check this box to
                                                indicate your agreement with the declaration above.</b> <b>*</b></label>
                                    </div>
                                    </p>
                                </div>
                                <p>In order to process your application we will need to store your data electronically.
                                    Please only submit this form if you agree to us holding this data.</p>
                                <p>I understand that this application and all other required documents needed to
                                    complete the SFFC volunteer application process are confidential and will not be
                                    disclosed without my written permission or court order. I also understand my access
                                    to my volunteer application and other required documents to complete the SFFC
                                    volunteer application process, will be governed by SFFC volunteer records policy.
                                </p>
                                <p>If you have any questions please call your <a
                                        href='https://safe-families.org/locations/' target='_blank'>local Safe
                                        Families for Children chapter</a>.</p>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <button class="submit" type="submit" name="apply" id="apply1">Get
                            Involved</button>
                        <button class="submit-dis" type="submit" id="apply2" style="display: none;"
                            disabled>Please Wait...</button>
                    </div>
                </div>

                <input type="hidden" name="referrer" class="form-control" value="" />
                <input type="hidden" name="status" class="form-control" value="new" />
                <input type="hidden" name="referral_id" class="form-control" value="" />
                <input type="hidden" name="vfid" class="form-control" value="" />
                <input type="hidden" name="vfmid" class="form-control" value="" />

            </div>

            <div id="noapply">

                <div class="row">
                    <div class="col-md-12">
                        <label>To apply as a volunteer for this chapter go to the following website:</label><br>
                        <a href='https://bethany.org/help-a-child/emergency-care/safe-families#SFFCVolunteer'
                            target='_blank'>Click here</a> to find out details of how to volunteer through Bethany
                        Christian Services.
                    </div>
                </div>

            </div>

        </form>

        <script>
            function showhide() {
                if ($("#HF_C").is(':checked') || $("#FF_C").is(':checked') || $("#FC_C").is(':checked')) {
                    $("#Ref_Panel").show();
                    $("#Drive_Panel").show();
                    $("#notresource").show();
                    $("#notresource2").show();
                    $("#notresource3").show();

                    if ($("#areaid").val().includes("##365")) {
                        $("#Drive_Panel").hide();
                    } else {
                        $("#Drive_Panel").show();
                    }

                } else {
                    $("#Ref_Panel").hide();
                    $("#Drive_Panel").hide();
                    $("#notresource").hide();
                    $("#notresource2").hide();
                    $("#notresource3").hide();
                }

                if ($("#areaid").val() == 'Bethany') {
                    $("#noapply").show();
                    $("#canapply").hide();
                } else {
                    $("#noapply").hide();
                    $("#canapply").show();
                }

                if ($("#anyone").val() == 'Y') {
                    $("#othmembers").show();
                } else {
                    $("#othmembers").hide();
                }


                if ($("#JL_C").is(':checked')) {
                    $("#otherrole").show();
                } else {
                    $("#otherrole").hide();
                }

                if ($("#ref8").val() == 'Yes') {
                    $("#ref8d").show();
                } else {
                    $("#ref8d").hide();
                }

                if ($("#ref7").val() == 'Yes') {
                    $("#ref7d").show();
                } else {
                    $("#ref7d").hide();
                }

            }

            $(document).ready(function() {

                function toggleDrivingSection() {
                    const driveValue = $('input[name="drive"]:checked').val();
                    if (driveValue === 'no_drive') {
                        $('#no_driving').show();
                        $('#no_driving_consent').show();
                        $('#yes_driving').hide();
                        $('#all_driving').show();
                    } else if (driveValue === 'may_drive') {
                        $('#no_driving').hide();
                        $('#yes_driving').show();
                        $('#no_driving_consent').hide();
                        $('#all_driving').show();

                    } else {
                        $('#no_driving').hide();
                        $('#yes_driving').hide();
                        $('#no_driving_consent').hide();
                        $('#all_driving').hide();
                    }
                }

                // Run on page load
                toggleDrivingSection();

                // Run whenever a radio button is clicked
                $('input[name="drive"]').change(toggleDrivingSection);

                // do your checks of the checkboxes here and show/hide what you want to
                showhide();

                // MAKE PANELS APPEAR

                $("#anyone").change(function() {
                    showhide();
                });

                $("#HF_C").change(function() {
                    showhide();
                });

                $("#FF_C").change(function() {
                    showhide();
                });

                $("#FC_C").change(function() {
                    showhide();
                });

                $("#JL_C").change(function() {
                    showhide();
                });

                $("#RF_C").change(function() {
                    showhide();
                });

                $("#ML_C").change(function() {
                    showhide();
                });

                $("#areaid").change(function() {
                    showhide();
                });

                $("#ref5").change(function() {
                    showhide();
                });

                $("#ref6").change(function() {
                    showhide();
                });

                $("#ref7").change(function() {
                    showhide();
                });

                $("#ref8").change(function() {
                    showhide();
                });

                $("#ref9").change(function() {
                    showhide();
                });

                $("#pdfform").submit(function() {
                    $("#apply1").hide();
                    $("#apply2").show();
                    return true;
                });

            });
        </script>

    @endsection
