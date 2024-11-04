/**
 * Represents a book.
 */
class Book {
    /**
     * Creates an instance of Book.
     * @param {string} title - The title of the book.
     * @param {string} author - The author of the book.
     */
    constructor(title, author) {
        this.title = title;
        this.author = author;
    }

    /**
     * Gets a description of the book.
     * @returns {string} - A formatted string with the title and author.
     */
    getDescription() {
        return `${this.title} written by ${this.author}`;
    }
}
