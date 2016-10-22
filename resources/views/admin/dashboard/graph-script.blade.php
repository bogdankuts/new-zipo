<script>
	//items
	var items = $("#itemBasicChart");
	var data = {
		labels: [
			"Без мета тегов",
			"С мета тегами"
		],
		datasets: [
			{
				data: [{{$noMetaItems}}, {{$allItems - $noMetaItems}}],
				backgroundColor: [
					"#F44336",
					"#FFAB40",
				],
				hoverBackgroundColor: [
					"#F44336",
					"#FFAB40",
				]
			}]
	};
	var options = {
		maintainAspectRatio: false,
		responsive: true
	};
	var itemsChart = new Chart(items, {
		type: 'doughnut',
		data: data,
		options: options,
	});

	//articles
	var articles = $("#articleBasicChart");
	var data_articles = {
		labels: [
			"Без мета тегов",
			"С мета тегами"
		],
		datasets: [
			{
				data: [{{$noMetaArticles}}, {{$allArticles - $noMetaArticles}}],
				backgroundColor: [
					"#F44336",
					"#FFAB40",
				],
				hoverBackgroundColor: [
					"#F44336",
					"#FFAB40",
				]
			}]
	};
	var articlesChart = new Chart(articles, {
		type: 'doughnut',
		data: data_articles,
		options: options,
	});

	//items_title
	var itemsTitle = $("#itemsTitleChart");
	var dataItemsTitle = {
		labels: [
			"Без мета тегов",
			"С мета тегами"
		],
		datasets: [
			{
				data: [{{$noTitleItems}}, {{$allItems - $noTitleItems}}],
				backgroundColor: [
					"#F44336",
					"#FFAB40",
				],
				hoverBackgroundColor: [
					"#F44336",
					"#FFAB40",
				]
			}]
	};
	var itemsTitleChart = new Chart(itemsTitle, {
		type: 'doughnut',
		data: dataItemsTitle,
		options: options
	});

	//items_description
	var itemsDescription = $("#itemsDescriptionChart");
	var dataItemsDescription = {
		labels: [
			"Без мета тегов",
			"С мета тегами"
		],
		datasets: [
			{
				data: [{{$noDescriptionItems}}, {{$allItems - $noDescriptionItems}}],
				backgroundColor: [
					"#F44336",
					"#FFAB40",
				],
				hoverBackgroundColor: [
					"#F44336",
					"#FFAB40",
				]
			}]
	};
	var itemsDescriptionChart = new Chart(itemsDescription, {
		type: 'doughnut',
		data: dataItemsDescription,
		options: options
	});

	//articles_title
	var articlesTitle = $("#articlesTitleChart");
	var dataArticlesTitle = {
		labels: [
			"Без мета тегов",
			"С мета тегами"
		],
		datasets: [
			{
				data: [{{$noTitleArticles}}, {{$allArticles - $noTitleArticles}}],
				backgroundColor: [
					"#F44336",
					"#FFAB40",
				],
				hoverBackgroundColor: [
					"#F44336",
					"#FFAB40",
				]
			}]
	};
	var articlesTitleChart = new Chart(articlesTitle, {
		type: 'doughnut',
		data: dataArticlesTitle,
		options: options
	});

	//items_description
	var articlesDescription = $("#articlesDescriptionChart");
	var dataArticlesDescription = {
		labels: [
			"Без мета тегов",
			"С мета тегами"
		],
		datasets: [
			{
				data: [{{$noDescriptionArticles}}, {{$allArticles - $noDescriptionArticles}}],
				backgroundColor: [
					"#F44336",
					"#FFAB40",
				],
				hoverBackgroundColor: [
					"#F44336",
					"#FFAB40",
				]
			}]
	};
	var articlesDescriptionChart = new Chart(articlesDescription, {
		type: 'doughnut',
		data: dataArticlesDescription,
		options: options
	});
</script>
