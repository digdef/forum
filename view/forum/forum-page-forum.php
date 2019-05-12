<article class="news">
	<div class="preview">
		<div style="width: 100%">
			<h2><?php echo $art['title'];?></h2>
			<?php echo mb_substr(strip_tags($art['text']), 0, 500, 'utf-8');?><br>
			<button onclick="location=`../forum.php?id=<?php echo $art['id']?>`" class="news-link">Подробнее</button>
		</div>
	</div>
</article>