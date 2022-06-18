@if (Auth::check())
<footer class="pb-6 p-4 flex justify-center md:justify-end">
  <span class="text-base sm:text-center">
    {{ date("Y"); }} <a href="/">Inventoxy™</a>. All Rights Reserved.
  </span>
</footer>
@endif