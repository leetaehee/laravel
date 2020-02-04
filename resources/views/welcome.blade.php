<?php //$items = []; ?>
<ul>
	@forelse($items as $item)
		<li>{{ $item }}</li>
	@empty
		<li>엥~ 아무것도 없는데요~</li>
	@endforelse
</ul>