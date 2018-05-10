$(function(){
	dynamicDropdown('/api/perum','#perumahan_id');

	$('#perumahan_id').change(function(){
		let url = '/api/block/${this.value}';
		let target = '#blockpilih';
		dynamicDropdown(url, target);
	});
});

function dynamicDropdown(url, selector){
	$.get(url, function (data){
		let $select = $(selector);

		$select.find('option').not('first').remove();

		let option = [];
		$.each(data, function(index, item){
			option.push('<option value="${item.id}">${item.name}</option>');
		})

		$select.append(options);
	});
}