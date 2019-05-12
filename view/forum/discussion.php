<div id="comment">
	<div>
		<div style="text-align: center;">
			<span><?php echo $comment['nick'];?></span>
		</div>
		<img id="avatar_img" src="../img/<?php echo $comment['avatar'];?>"></p>
	</div>
	<div id="comment1">
		<span>
			<?php echo $comment['answer_nick'];?>
			<?php echo $comment['text'];?><br>
		</span>
		<button class="news-link forum-link" onclick="answer(`<?php echo $comment['nick'];?>`)">Ответить</button>
	</div>
</div>