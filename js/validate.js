jQuery(document).ready(function($) {
    var bouton = true;
    $('input[type="submit"]').click(function(event) {
        if(bouton == true){
            $(window).scrollTop('300');
            bouton = false;
        }
    });
    jQuery.validator.setDefaults({
        errorElement: "em",
        errorPlacement: function( label, element ) {
            if( element.attr( "name" ) === "typeEcole" || element.attr( "name" ) === "civResp" || element.attr( "name" ) === "civEns" || element.attr( "name" ) === "classe[]") {
        element.parent().next().append(label ); // this would append the label after all your checkboxes/labels (so the error-label will be the last element in <div class="controls"> )
    }
    else if(element.attr( "name" ) === "Choix1" || element.attr( "name" ) === "Choix2" || element.attr( "name" ) === "Choix3") {
        element.parent().append(label );
    }
    else {
        label.insertAfter( element ); // standard behaviour
    }
}
});

    $( "#form1" ).validate({
      rules: {
        typeEcole: {
            required: true,
        },
        nomEcole: {
            required: true,
            minlength: 5
        },
        addr1: {
            required:true,
        },
        cp: {
            required:true,
            number: true,
            minlength: 5,
            maxlength: 5
        },
        ville: {
            required:true,
        },
        tel: {
            required:true,
            number: true,
            minlength:10,
            maxlength:10
        },
        addrmail: {
            required: true,
            email: true
        },
        civResp: {
            required:true
        },
        nomResp: {
            required:true,
        },
        prenResp: {
            required:true,
        },
        facture: {
            required:true,
        }

    },
    messages: {
        typeEcole: {
            required: "Vous devez saisir le type de votre Etablissement",
        },
        nomEcole: {
            required: "Vous devez entrer le nom de votre établissement",
        },
        addr1: {
            required: "Vous devez entrer l'adresse principale de votre établissement",
        },
        cp: {
            required: "Vous devez entrer le code postal de votre établissement",
            minlength: "Entrez au minimum {0} caractères",
            number: "Entrez un code postal valide",
            maxlength: "Entrez au maximum {0} caractères"
        },
        ville: {
            required: "Vous devez entrez la ville de votre établissement",
        },
        tel: {
            required: "Vous devez entrer le téléphone de votre établissement",
            number: "Entrez un numéro valide",
            minlength: "Veuillez indiquer le téléphone sans espace",
            maxlength: "Le numéro est incorrect"
        },
        addrmail : {
            required: "Vous devez entrer une adresse mail valide",
            email: "Entrer une adresse mail valide"
        },
        civResp: {
            required: "Vous devez entrer la civilité du responsable"
        },
        nomResp: {
            required: "Vous devez entrer le nom du responsable",
        },
        prenResp: {
            required: "Vous devez entrer le prénom du responsable",
        },
        facture: {
            required: "N'oubliez pas d'indiquer à qui libeller la facture !",
        }
    },
});
$( "#form2" ).validate({
  rules: {
    civEns: {
        required: true,
    },
    nomEns: {
        required: true,
    },
    prenEns: {
        required:true,
    },
    telEns: {
        number: true,
        minlength:10,
        maxlength:10
    },
    'classe[]': {
        required:true
    },
    nbrEleve: {
        required:true,
        number:true
    },
    nbrAccom: {
        required: true,
        number: true
    }
},
messages: {
    civEns: {
        required: "Vous devez saisir la civilité de l'enseignant",
    },
    nomEns: {
        required: "Vous devez entrer le nom de l'enseignant",
    },
    prenEns: {
        required: "Vous devez entrer le prénom de l'enseignant",
    },
    telEns: {
        number: "Vous devez entrer un téléphone valide",
        minlength: "Vous devez entrer un téléphone valide",
        maxlength: "Vous devez entrer un téléphone valide"
    },
    'classe[]': {
        required: "Vous devez saisir au moins une classe",
    },
    nbrEleve: {
        required: "Vous devez entrer le nombre d'élèves",
        number: "Vous devez entrer un nombre"
    },
    nbrAccom: {
        required: "Vous devez entrer le nombre d'accompagnateurs",
        number: "Vous devez entrer un nombre"
    }
}
});
$( "#form3" ).validate({
  rules: {
    Choix1: {
        required: true,
    },
    impo1: {
        minlength: 5,
    }
},
messages: {
    Choix1: {
        required: "Vous devez saisir votre premier choix"
    },
    impo1: {
        minlength: "{0} caractères minimum"
    }
}
});
$( "#form4" ).validate({
  rules: {
    Choix2: {
        required: true,
    }
},
messages: {
    Choix2: {
        required: "Vous devez saisir votre deuxième choix"
    }
}
});
$( "#form5" ).validate({
  rules: {
    Choix3: {
        required: true,
    }
},
messages: {
    Choix3: {
        required: "Vous devez saisir votre trsoième choix"
    }
}
});

});
