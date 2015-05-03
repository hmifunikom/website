<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{action('cakrawala.index')}}">
                <span class="cakrawala-logo active"></span>
                <span class="cakrawala-logo green"></span>
                <span class="cakrawala-logo red"></span>
                <span class="cakrawala-logo blue"></span>
                <span class="cakrawala-logo black"></span>
                Cakrawala
            </a>
        </div>
        <div class="navbar-collapse collapse">
            <a type="button" class="btn btn-default navbar-btn navbar-right" href="{{ action('cakrawala.pendaftaran') }}">{{ Helper::fa('sign-in') }} Daftar/Masuk</a>
            <ul class="nav navbar-nav navbar-right" id="menu">
                <li data-menuanchor="DebatIT" class="debat"><a href="#DebatIT">Debat IT</a></li>
                <li data-menuanchor="ITContest" class="itcontest"><a href="#ITContest">IT Contest</a></li>
                <li data-menuanchor="LKTI" class="lkti"><a href="#LKTI">LKTI</a></li>
                <li data-menuanchor="TheColorRun" class="thecolorrun"><a href="#TheColorRun">The Color Run</a></li>
                <li data-menuanchor="Contact" class="contact"><a href="#Contact">Contact</a></li>
                
            </ul>
        </div><!--/.navbar-collapse -->
    </div>
</div>