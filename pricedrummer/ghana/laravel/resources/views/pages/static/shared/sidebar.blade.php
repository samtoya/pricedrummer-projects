<div class="sidebar" style="background-color: #FFFFFF;padding: 10px; margin-top: 12px;border-top: 2px solid #104e84;">
    <ul>
        <h4>About PriceDrummer</h4>
        <li><a href="{{url('/about')}}">About Us</a></li>
        <li><a href="/careers">Careers</a></li>
        <li><a href="/all_categories">Categories A-Z</a></li>
        <li><a href="/press">Press</a></li>
        <li><a href="/contact">Contact</a></li>
    </ul>

    <ul>
        <h4 style="margin-top: 25px;">Support</h4>
        <li><a href="/guides">How to use PriceDrummer</a></li>
        <li><a href="/for_retailers">Sell on PriceDrummer</a></li>
        <li><a href="/terms_policy">Terms of Use &amp; Privacy
                Policy</a></li>
        <li><a href="/rules_regulations">Rules &amp;
                Regulations</a></li>
        <li><a href="/faq">FAQ</a></li>
    </ul>

    <ul>
        <h4 style="margin-top: 25px;">Social</h4>
        @foreach( $social_media as $key => $link )
            <li class=footer-list-item">
                <a target=_blank href="{{$link}}">{{$key}}</a>
            </li>
        @endforeach
    </ul>
</div>