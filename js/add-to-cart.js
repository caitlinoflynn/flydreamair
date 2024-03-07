window.onload = function(){
	//cart box
	const iconShopping = document.querySelector('.iconShopping');
	const cartCloseBtn = document.querySelector('.fa-close');
	const cartBox = document.querySelector('.cart-dropdown-content');
	iconShopping.addEventListener("click",function(){
		cartBox.classList.add('active');
	});
	cartCloseBtn.addEventListener("click",function(){
		cartBox.classList.remove('active');
	});


	// adding data to localstorage
	const attToCartBtn = document.getElementsByClassName('add-to-cart');
	let items = [];
	for(let i=0; i<attToCartBtn.length; i++){
		attToCartBtn[i].addEventListener("click",function(e){
		//	alert(e.target.parentElement.children[1].children[3].children[0].children[3].value)
			if(typeof(Storage) !== 'undefined'){
				let item = {
						id:i+1,
				    	img:e.target.parentElement.children[0].children[0].children[0].src,
						name:e.target.parentElement.children[1].children[0].textContent,
						price:e.target.parentElement.children[1].children[2].children[0].children[0].textContent,
					    loyaltyPoints: e.target.parentElement.children[1].children[2].children[1].children[1].textContent,
						no: e.target.parentElement.children[1].children[3].children[0].children[3].value
					};
				if(JSON.parse(localStorage.getItem('items')) === null){
					items.push(item);
					localStorage.setItem("items",JSON.stringify(items));
					window.location.reload();
				}else{
					const localItems = JSON.parse(localStorage.getItem("items"));
					localItems.map(data=>{
						if(item.id == data.id){
							if (item.no == 0) {
								alert('Please enter a value greater than 0')
								item.no = data.no;
							} else {
								item.no = data.no + 1;
							}

						}else{
							items.push(data);
						}

					});
					items.push(item);
					localStorage.setItem('items',JSON.stringify(items));
					window.location.reload();
				}
			}else{
				alert('local storage is not working on your browser');
			}
		});
	}
	// adding data to shopping cart 
	const iconShoppingP = document.querySelector('.iconShopping p');
	let no = 0;
	JSON.parse(localStorage.getItem('items')).map(data=>{
		no = no+data.no
;	});
	iconShoppingP.innerHTML = no;


	//adding cartbox data in table
	const cardBoxTable = cartBox.querySelector('table');
	let tableData = '';
	if(JSON.parse(localStorage.getItem('items'))[0] === null){
		tableData += '<tr><td colspan="5">No items found</td></tr>'
	}else{
		JSON.parse(localStorage.getItem('items')).map(data=>{
			tableData += '<tr>' +
				'<td><span style="visibility: hidden">'+data.id+'</span>' +
				'<img class="cart-img" src="'+data.img+'" alt="img"></td>' +
				'<td><div class="cart-name">'+data.name+'' +
				'<br><br>' +
				'<span class="cart-price">Price: '+data.no+' x '+data.price+' or '+data.loyaltyPoints+'</span>' +
				'</td>' +
				'<td><a href="#" onclick=Delete(this);>Delete</a></td>' +
				'' +
				'</tr>';
		});
	}
	cardBoxTable.innerHTML = tableData;
}