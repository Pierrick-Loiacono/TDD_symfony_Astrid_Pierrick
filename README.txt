


Bouchon / Stubs : simuler le comportement d'une méthode. (ne fait pas echouer un test)
Imitation(doublure) / mocks : tester qu'on appelle bien la valeur d'un objet (peut faire echouer un test)

Comment créer cela:
$mock_obj = createMock(My::Class_Or_Interface);

Pour plus de détail, utiliser un mockBuilder
$mocj = getMockBuilder($originalClassName)->disableOriginalConstructor()->....


TOut appel de méthode de la doublue retourne null.
Possibilité de surcharge:
$mock->method('doSomething')->will($this->returnValue($value));

On peut retourner differentes valeurs tel que des tableaux, des valeurs successives, lever des exceptions... :
->will($this->.....)


Methode appellée une seule fois
$observer->expects($this->once())->method('update')->with($this->equelTo('something'));

->with peut prendre plus parametres:
->with(
    $this->greaterThan(0);
    $this->stringContains('Something')
    );

Test si la methode est appellée plusieurs fois
$mock->expects($this->exactly(2))->method('set')->withConsecutive(
                                                               [$this->equelTo('foo'), $this-<greaterThan(0)],
                                                               [$this->equelTo('bar'), $this-<greaterThan(0)],
                                                               );





