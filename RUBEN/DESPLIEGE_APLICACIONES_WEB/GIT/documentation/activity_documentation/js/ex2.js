/**
 * Returns product details.
 * @param {Object} product - The product object.
 * @param {string} product.name - The name of the product.
 * @param {number} product.price - The price of the product.
 * @param {string[]} product.tags - Tags associated with the product.
 * @returns {string} - A formatted string with product details.
 */
function getProductDetails(product) {
    return `${product.name} costs $${product.price} and has tags ${product.tags.join(", ")}`;
}
