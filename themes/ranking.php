<?php require_once('themes/inc/naglowek.php'); ?>

<div class="container marginRanking">
	<table class="rankingTable">
		<thead class="theadRanking">
			<tr class="tableHeaderRanking">
				<th class="text-center">Lp.</th>
				<th class="pl-4">Nazwa użytkownika</th>
				<th class="text-center plusColumn">Otrzymane plusy</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$ranking = new Ranking($default_db);
				$ranking->showRanking();
			?>
		</tbody>
	</table>
</div>

<?php require_once('/themes/inc/footer.php');?>