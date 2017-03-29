var myNumber = 45;

// Egalité SIMPLE : vérifier la valeur de la variable

console.log( myNumber == 45); // => True
console.log( myNumber == "45");  // => True

// Inégalité SIMPLE : vérifier la valeur de la variable
console.log( myNumber != 45 ); // => False
console.log( myNumber != "45"); // => False

console.log( myNumber != 12); // => True
console.log( myNumber != "12"); // => True

// Egalité STRICTE : vérifier la valeur ET le type de la variable
console.log( myNumber === 45 ); // => True 
console.log( myNumber === "45"); // => False

// Inégalité STRICTE : vérigier la valeur ET le type de la varibale
console.log( myNumber !== 45 ); // => False
console.log( myNumber !== "45"); // => True

// Supérieur / inférieur
console.log( myNumber > 46 ); // => False 
console.log( myNumber < 46 ); // => True

// Supérieur ou égale / Inférieur ou égale
console.log( myNumber >= 12 ); // => True
console.log( myNumber <= 20 ); // => False

console.log( myNumber >= 45 ); // => True
console.log( myNumber <= 45 ); // => True
