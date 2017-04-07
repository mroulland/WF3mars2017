// Importer la class Component
import { Component, OnInit } from '@angular/core';

// Importer la class router
import { Router } from '@angular/router';

// Définir le décorateur @Component({...}) c'est une fonction qui prend comme paramètre un objet
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})

// Exporter la class du composant (il ne faut pas de ; entre les deux, il faut le faire immédiatement après)
export class AppComponent implements OnInit {

  // Initier le routeur dans le constructeur de composant
  constructor(
    private router: Router
  ){}

  private burgerIsOpen = false;

  // Créer une fonction à appeler au click sur .fa-bars
  openBurger(){

    if( this.burgerIsOpen == false){
 
    // Changer la valeur de burgerIsOpen
    this.burgerIsOpen = true;

    } else{
    
     // Changer la valeur de burgerIsOpen
    this.burgerIsOpen = false;     
    };
  };

  // Créer une fonction pour fermer le burger menu
  closeBurger(link){

    // Fermer le burger menu 
    this.burgerIsOpen = false;

    // Naviguer vers la bonne vue
    this.router.navigate(link);

  }

  // Attendre le chargement du composant
  ngOnInit(){
    console.log('Le composant est chargé')
    
    // Créer une variable pour sélectionner le loader en JavaScript
    let loader = document.getElementById('appLoader');
    
    // Ajouter la class closedLoader à la balise
    loader.classList.add('closedLoader');

  }


};