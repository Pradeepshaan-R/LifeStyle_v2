</div>
<!--app-->

<hr />
<div class="flex-center text-center text-sm">
    <a href="{{url('/terms')}}">Terms & Conditions</a> •
    <a href="{{url('/privacy')}}">Privacy Policy</a>
</div>
<p class="flex-center text-center text-sm">2021 © Crafted with &nbsp; <i class="fa fa-heart text-danger"></i> &nbsp; by
    Share Colombo.</p>

@stack('before-scripts')
<script src="{{ asset(mix('js/manifest.js')) }}"></script>
<script src="{{ asset(mix('js/vendor.js')) }}"></script>
<script src="{{ asset(mix('js/frontend.js')) }}"></script>
<livewire:scripts />
@stack('after-scripts')
</body>

</html>
