<footer class="bd-footer">
  @if(Auth::check())
    <ul class="bd-footer-links">
      <li><a href="https://goo.gl/forms/7X06aUxuT2ALjjJy1">Questionário</a></li>
      <li><a href="/sobre">Sobre a Lancheria</a></li>
    </ul>
  @else
    <ul class="bd-footer-links">
      <li><a href="/sobre">Sobre a Lancheria</a></li>
    </ul>
  @endif
  <p class="text-muted">Website construído por Kelvin da Silva Teixeira</p>
  <p class="text-muted">Slaughterhouse Software Development &copy;. All rights reserved.</p>
</div>
</footer>
