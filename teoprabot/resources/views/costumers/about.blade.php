@extends('costumers.layouts.template')
@section('css')
<style>

/*---------------------
  Map
-----------------------*/

.map {
	height: 500px;
	position: relative;
}

.map iframe {
	width: 100%;
}

.map .map-inside {
	position: absolute;
	left: 50%;
	top: 160px;
	-webkit-transform: translateX(-175px);
	-ms-transform: translateX(-175px);
	transform: translateX(-175px);
}

.map .map-inside i {
	font-size: 48px;
	color: #7fad39;
	position: absolute;
	bottom: -75px;
	left: 50%;
	-webkit-transform: translateX(-18px);
	-ms-transform: translateX(-18px);
	transform: translateX(-18px);
}

.map .map-inside .inside-widget {
	width: 350px;
	background: #ffffff;
	text-align: center;
	padding: 23px 0;
	position: relative;
	z-index: 1;
	-webkit-box-shadow: 0 0 20px 5px rgba(12, 7, 26, 0.15);
	box-shadow: 0 0 20px 5px rgba(12, 7, 26, 0.15);
}

.map .map-inside .inside-widget:after {
	position: absolute;
	left: 50%;
	bottom: -30px;
	-webkit-transform: translateX(-6px);
	-ms-transform: translateX(-6px);
	transform: translateX(-6px);
	border: 12px solid transparent;
	border-top: 30px solid #ffffff;
	content: "";
	z-index: -1;
}

.map .map-inside .inside-widget h4 {
	font-size: 22px;
	font-weight: 700;
	color: #1c1c1c;
	margin-bottom: 4px;
}

.map .map-inside .inside-widget ul li {
	list-style: none;
	font-size: 16px;
	color: #666666;
	line-height: 26px;
}
.contact-section {
            padding: 60px 0;
        }
        .contact-info {
            margin-bottom: 30px;
        }
        .contact-info h4 {
            margin-bottom: 15px;
        }
        .contact-info p {
            margin-bottom: 10px;
        }
        .social-icons a {
            margin: 0 10px;
            font-size: 24px;
            color: #333;
            text-decoration: none;
        }
        .form-control {
            margin-bottom: 15px;
        }

        .section {
            padding: 60px 0;
        }
        .section-title {
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .text-section {
            margin-bottom: 30px;
        }
        .img-section img {
            width: 100%;
            height: auto;
        }
        .quote {
            font-style: italic;
            margin-top: 20px;
        }
@media only screen and (max-width: 479px) {.map .map-inside {
		-webkit-transform: translateX(-125px);
		-ms-transform: translateX(-125px);
		transform: translateX(-125px);
	}
	.map .map-inside .inside-widget {
		width: 250px;
	}
}
</style>
@endsection
@section('main-content')
<br><br>


<div class="container">
    <div class="row section">
        <div class="col-md-6 text-section">
            <h2 class="section-title">Our Story</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat consequat enim, non auctor massa ultrices non. Morbi sed odio massa. Quisque at vehicula tellus, sed tincidunt augue. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas varius egestas diam, eu sodales metus scelerisque congue.</p>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas gravida justo eu arcu egestas convallis. Nullam eu erat bibendum, tempus ipsum eget, dictum enim. Donec non neque ut enim dapibus tincidunt vitae nec augue. Suspendisse potenti. Proin ut est diam. Donec condimentum euismod tortor, eget facilisis diam faucibus et. Morbi a tempor elit.</p>
            <p>Donec gravida lorem elit, quis condimentum ex semper sit amet. Fusce eget ligula magna. Aliquam aliquam imperdiet sodales. Ut fringilla turpis in vehicula vehicula. Pellentesque congue ac orci ut gravida. Aliquam erat volutpat. Donec iaculis lectus a arcu facilisis, eu sodales lectus sagittis.</p>
            <p>Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (014) 96 716 6879</p>
        </div>
        <div class="col-md-6 img-section">
            <img src="{{asset('costumer/img/pengirim.jpg')}}" alt="Our Story Image">
        </div>
    </div>
    <div class="row section">
        <div class="col-md-6 img-section">
            <img src="{{asset('costumer/img/pengirim.jpg')}}" alt="Our Mission Image">
        </div>
        <div class="col-md-6 text-section">
            <h2 class="section-title">Our Mission</h2>
            <p>Mauris non lacinia magna. Sed nec lobortis dolor. Vestibulum rhoncus dignissim risus, sed consectetur erat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam maximus mauris sit amet odio convallis, in pharetra magna gravida.</p>
            <p>Present sed nunc fermentum mi molestie tempor. Morbi vitae viverra odio. Pellentesque ac velit egestas, luctus arcu non, laoreet mauris. Sed in ipsum tempor, consectetur odio in, porttitor ante. Ut mauris ligula, volutpat in sodales in, porta non odio.</p>
            <p>Pellentesque tempor urna vitae mi vestibulum, nec venenatis nulla lobortis. Proin et gravida ante. Mauris auctor purus at luctus maximus. Pellentesque vulputate massa ut nisi hendrerit, eget elementum libero iaculis.</p>
            <p class="quote">
                "Creativity is just connecting things. When you ask creative people how they did something, they feel a little guilty because they didn't really do it, they just saw something. It seemed obvious to them after a while." <br> - Steve Job's
            </p>
        </div>
    </div>
</div>
<h2 class="text-center">Lokasi</h2>
<div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d248.88717759246566!2d98.62535023703066!3d3.5424754272753716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30312f033dd2444b%3A0xad060f53222046a3!2sTeo%20Prabot%20366!5e0!3m2!1sid!2sid!4v1716485422562!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <div class="map-inside">
        <i class="icon_pin"></i>
        <div class="inside-widget">
            <h4>Medan</h4>
            <ul>
                <li>Phone: +12-345-6789</li>
                <li>Gg. Bonsai No.12, Sempakata, Kec. Medan Selayang, Kota Medan, Sumatera Utara 20133 </li>
                <li>Gang paling ujung mentok</li>
            </ul>
        </div>
    </div>
</div>


<div class="container contact-section">
    <div class="row">
        <div class="col-md-6 contact-info">
            <h2>Contact Us</h2>
            <p>There are many ways to contact us. You may drop us a line, give us a call or send an email, choose what suits you the most.</p>
            <p><strong>Phone:</strong> (800) 686-6688</p>
            <p><strong>Email:</strong> info.deercreative@gmail.com</p>
            <p><strong>Address:</strong> mm</p>
            <p><strong>Open hours:</strong> 8:00 - 18:00 Mon-Fri</p>
            <p><strong>Sunday:</strong> Closed</p>
            <h4>Follow Us</h4>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-google"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <div class="col-md-6">
            <h2>Get In Touch With Us!</h2>
            <p>Fill out the form below to receive a free and confidential.</p>
            <form>
                <input type="text" class="form-control" placeholder="Name" required>
                <input type="email" class="form-control" placeholder="Email" required>
                <input type="url" class="form-control" placeholder="Website">
                <textarea class="form-control" rows="5" placeholder="Message" required></textarea>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>
</div>
@endsection
