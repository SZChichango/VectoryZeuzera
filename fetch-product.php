

<section class="product">
    <div class="product-images">
        <img class="product-img" src="./VZ/<?=$item['image']?>" alt="<?=$item['item_name']?>" />
        <div class="slider">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="grid-flow">
        <div class="product-info">
            <h2><?=$item['item_name']?></h2>
            <span class="product-price"><?=$item['price']?></span>

            <div class="size">
                <h3>Select Size:</h3>
                <select id="size" name="size" required>
                    <option value="">--Please Select--</option>
                    <option value="XS">XS</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                </select>
            </div>
            <h3>Quantity</h3>
            <div class="product-quantity">
                <span><i class="fa-solid fa-plus"></i></span>
                <input type="number" value="1" name="quantity" required />
                <span><i class="fa-solid fa-minus"></i></span>
            </div>
            <div class="product-description">
                <h3>Description</h3>
                <p>
                    <?=$item['description']?>
                </p>
            </div>
        </div>
        <div class="fav-cart sticky">
            <button id="add-to-cart__button">Add To Cart</button>
            <button id="favourite__button">
                <i class="fa-regular fa-heart"></i>
            </button>
        </div>
    </div>
</section>


