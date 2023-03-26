function updateVilleField() {
    const codePostalInput = $('input[name="code_postal"]');
    const villeInput = $('select[name="ville"]');
    const codePostal = codePostalInput.val().trim();
    if (codePostal.length === 5 && /^\d+$/.test(codePostal)) {
      const url = `https://geo.api.gouv.fr/communes?codePostal=${codePostal}&fields=nom&format=json&geometry=centre`;
      $.getJSON(url, function(data) {
        villeInput.empty();
        if (data.length > 0) {
          villeInput.append($('<option>').text('Sélectionner une ville'));
          $.each(data, function(_, ville) {
            villeInput.append($('<option>').text(ville.nom));
          });
        } else {
          villeInput.append($('<option>').text('Aucune ville trouvée'));
        }
      })
      .fail(function() {
        console.error('Erreur lors de la recherche de la ville');
        villeInput.empty().append($('<option>').text('Erreur lors de la recherche de la ville'));
      });
    } else {
      villeInput.empty().append($('<option>').text('Entrez un code postal valide'));
    }
  }
  
  const codePostalInput = $('input[name="code_postal"]');
  codePostalInput.on('input', updateVilleField);
  
  const paysInput = $('input[name="pays"]');
  const villeDiv = $('#ville');
  
  function updateVilleInput() {
    const pays = paysInput.val().trim();
    if (pays.toLowerCase() === 'france') {
      villeDiv.empty().append($('<select>').attr('name', 'ville'));
      updateVilleField();
    } else {
      villeDiv.empty().append($('<input>').attr('type', 'text').attr('name', 'ville'));
    }
  }
  
  paysInput.on('input', updateVilleInput);