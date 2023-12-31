<?php if($loginpage!=1){ ?>
<div id="footer-bar" class="footer-bar-1">
<a href="index.html" class="active-nav"><i class="fa fa-home"></i><span>Home</span></a>
<a href="index-components.html"><i class="fa fa-star"></i><span>Features</span></a>
<a href="index-pages.html"><i class="fa fa-heart"></i><span>Pages</span></a>
<a href="index-search.html"><i class="fa fa-search"></i><span>Search</span></a>
<a href="#" data-menu="menu-settings"><i class="fa fa-cog"></i><span>Settings</span></a>
</div>


<div id="menu-settings" class="menu menu-box-bottom menu-box-detached">
<div class="menu-title mt-0 pt-0"><h1>Settings</h1><p class="color-highlight">Flexible and Easy to Use</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a></div>
<div class="divider divider-margins mb-n2"></div>
<div class="content">
<div class="list-group list-custom-small">
<a href="#" data-toggle-theme data-trigger-switch="switch-dark-mode" class="pb-2 ms-n1">
<i class="fa font-12 fa-moon rounded-s bg-highlight color-white me-3"></i>
<span>Dark Mode</span>
<div class="custom-control scale-switch ios-switch">
<input data-toggle-theme type="checkbox" class="ios-input" id="switch-dark-mode">
<label class="custom-control-label" for="switch-dark-mode"></label>
</div>
<i class="fa fa-angle-right"></i>
</a>
</div>
<div class="list-group list-custom-large">
<a data-menu="menu-highlights" href="#">
<i class="fa font-14 fa-tint bg-green-dark rounded-s"></i>
<span>Page Highlight</span>
<strong>16 Colors Highlights Included</strong>
<span class="badge bg-highlight color-white">HOT</span>
<i class="fa fa-angle-right"></i>
</a>
<a data-menu="menu-backgrounds" href="#" class="border-0">
<i class="fa font-14 fa-cog bg-blue-dark rounded-s"></i>
<span>Background Color</span>
<strong>10 Page Gradients Included</strong>
<span class="badge bg-highlight color-white">NEW</span>
<i class="fa fa-angle-right"></i>
</a>
</div>
</div>
</div>
<?php } ?>
<script type="text/javascript" src="scripts/bootstrap.min.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>

<div class="menu-hider"></div><p class="offline-message bg-red-dark color-white">No internet connection detected</p><p class="online-message bg-green-dark color-white">You are back online</p>