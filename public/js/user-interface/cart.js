/**
 * Created by BogdanKootz on 12.10.16.
 * this is created by Oleg Kukharuk
 * v 1.0
 */
var setCookie = function (name, value, expires, path, domain, secure) { document.cookie = name + "=" + escape(value) +((expires) ? "; expires=" + expires : "") +((path) ? "; path=" + path : "") +((domain) ? "; domain=" + domain : "") +((secure) ? "; secure" : ""); };
var getCookie = function (name) { var cookie = " " + document.cookie; var search = " " + name + "="; var setStr = null; var offset = 0; var end = 0; if (cookie.length > 0) { offset = cookie.indexOf(search); if (offset != -1) { offset += search.length; end = cookie.indexOf(";", offset); if (end == -1) { end = cookie.length; } var setStr = unescape(cookie.substring(offset, end)); } } return(setStr); };

// { "product_id": product_id,
//   "title": title,
//   "price": price,
//   "count": count }

var shopcart = {
	add: function(id, price, count) {
		console.log(price);
		var oldJSON = this.get(),
			newJSON = [],
			founded = 0;
		if (oldJSON) {
			newJSON = oldJSON;
			for(var i=0; i < oldJSON.length; i++) {
				if (oldJSON[i].id===id) {
					founded = i;
				}
			}
		}
		if (founded > 0) {
			newJSON[founded].count = newJSON[founded].count + count;
		} else {
			var newItem = {"id" : id, "price" : price,"count" : count};
			console.log(newItem);
			newJSON.push( newItem );
		}
		newJSON = JSON.stringify(newJSON);
		this.set(newJSON);
		this.check(id);
	},
	recalc: function(id, count) {
		var oldJSON = this.get(),
			newJSON = [];
		if (oldJSON) {
			for(var i=0; i < oldJSON.length; i++) {
				if (oldJSON[i].id===id) {
					oldJSON[i].count = count;
				}
				newJSON.push( oldJSON[i] );
			}
		}
		newJSON = JSON.stringify(newJSON);
		this.set(newJSON);
	},
	remove: function(id) {
		var oldJSON = this.get(),
			newJSON = [];
		if (oldJSON) {
			for(var i=0; i < oldJSON.length; i++) {
				if (oldJSON[i].id!==id) {
					newJSON.push( oldJSON[i] );
				}
			}
		}
		newJSON = JSON.stringify(newJSON);
		this.set(newJSON);
		console.log('remove ' + id + ' is run');
		//$('.item_' + id + ' .js_item_add').show();
		//$('.item_' + id + ' .js_item_cart').hide();
	},
	clear: function() {
		setCookie('shopcartItems', '', 'Mon, 01-Jan-1000 00:00:00 GMT', '/');
		this.check();
	},
	check: function(id) {
		if (id > 0) {
			console.log('.itemId_' + id + ' .addToCart');
			$('.item_' + id + ' .js_item_add').hide();
			$('.item_' + id + ' .js_item_cart').css('display', 'block');
		} else {
			var oldJSON = this.get();
			if (oldJSON) {
				for(var i=0; i < oldJSON.length; i++) {
					$('.item_' + oldJSON[i].id + ' .js_item_add').hide();
					$('.item_' + oldJSON[i].id + ' .js_item_cart').css('display', 'block');
				}
			}
		}
		this.show('.totalPositionsContainer', '.totalAmountContainer');
	},
	refresh: function() {

	},
	show: function(selectorCount, selectorPrice) {
		var oldJSON     = this.get(),
			amountCount = 0,
			amountPrice = 0;
		if (oldJSON) {
			for(var i=0; i < oldJSON.length; i++) {
				var thisTotalPrice = oldJSON[i].count * oldJSON[i].price,
					amountCount    = amountCount + oldJSON[i].count,
					amountPrice    = amountPrice + thisTotalPrice;
				if (selectorPrice === '.totalAmountContainer') {
					amountPrice = Math.round((amountPrice)*100)/100;
				}
			}
			$(selectorCount).html(amountCount);
			$(selectorPrice).html(amountPrice);
		}
	},
	get: function() {
		var cookie = getCookie('shopcartItems');
		if (cookie) {
			var json = $.parseJSON(cookie);
			if (json) {
				return json;
			} else {
				console.log('Error on Cookie -> JSON');
				return false;
			}
		} else {
			console.log('Cookie not found');
			return false;
		}
	},
	set: function(value) {
		return setCookie('shopcartItems', value, 'Mon, 01-Jan-5000 00:00:00 GMT', '/');
	}
};

$(document).ready(function () {
	// AddToCart Event
	$(document).on('click', '.js_item_add', function(){
		var $this = $(this);
		var id    = $this.data('id'),
			price = $this.data('price'),
			count = 1;
		console.log('add event');
		shopcart.add(id, price, count);
	});

	// AddToCart Event
	$(document).ready(function(){
		//shopcart.clear();
		shopcart.check(0);
	});

	// Remove Item Event
	$(document).on('click', '.js_item_remove', function(){
		var $this = $(this),
			id    = $this.data('id');
		console.log('id = ' + id);
		shopcart.remove(id);
		$('#itemsRow_'+id).fadeOut(300).remove();
		shopcart.check(0);
	});

	// Items Count Event
	$(document).on('change', '.countItemsEvent', function(){
		var $this = $(this),
			id    = $this.data('id'),
			price = $this.data('price') * 1,
			count = $this.val() * 1;
		var total = price * count;
		total = Math.round((total)*100)/100;
		console.log('total: ' + total);
		shopcart.recalc(id, count);
		$('#itemTotal_'+id).html(total);
		shopcart.check(0);
	});
});

$('.js_item_add').on('click', function(e) {
	e.preventDefault();
});

