<article class="news">
	<div class="preview">
		<a style="padding-right: 20px;" href="">
			<img class="img" src="<?php echo $art['img'] ?>">
		</a>
		<div style="width: 100%">
			<h2><?php echo $art['title'];?></h2>
			<?php echo mb_substr(strip_tags($art['text']), 0, 500, 'utf-8')?><br>
			<button onclick="location=`../news.php?id=<?php echo $art['id']?>`" class="news-link">Подробнее</button>
		</div>
	</div>
</article>