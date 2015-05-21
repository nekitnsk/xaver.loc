var name='Игорь', age='30';
var CONST_CITY = 'Новосибирск';
var book = {title: "Шантарам", 
            author: 'Дэвид Грегори Робертс',
             pages: '850'}



//111111111111111111111111111111111111
console.log('Меня зовут '+name);
console.log('Мне '+age+' лет');
delete name;
delete age;


//2222222222222222222222222222222222


if (typeof CONST_CITY !=="undefined"){
console.log(CONST_CITY);
  CONST_CITY = 'Искитим';
  console.log('Изменить константу ваще не проблема: '+ CONST_CITY);
    
}else{
console.log('Нет такой константы');

}

delete CONST_CITY;

//3333333333333333333333333333333333333333

console.log("Недавно я прочитал книгу "+ book.title + " написанную автором "+ book.author + ", я осилил все " + 
            book.pages + " страниц, мне она очень понравилась");
            
delete book;

//44444444444444444444444444444444444444444
function Books(title,author,pages){
  this.title = title;
  this.author=author;
  this.pages=pages;
    
}

book1 = new Books("Преступление и наказание", "Достоевский", 450);
book2 = new Books("Шантарам", "Грегори Дэвид Робертс", 850);

console.log("Недавно я прочитал книги " + book1.title + " и " + book2.title + ", написанные соответственно авторами " + book1.author + " и " + book2.author + ", я осилил в сумме "+ (book1.pages + book2.pages) + " страниц, не ожидал от себя подобного");

delete Books;
