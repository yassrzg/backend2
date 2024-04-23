import React, { useState, useEffect } from 'react';

import axios from 'axios';


export default function Produit({slug}) {

    const [produit, setProduit] = useState([]);

    useEffect(() => {
        axios
            .get(`/api/getProduit/${slug}`)
            .then((response) => {
                console.log(response.data);
                setProduit(response.data);
            })
            .catch((error) => {
                console.error(error);
            });
    }, []);


    return(
        <div>
            {produit.map((product) => (
                <div key={product.id}>
                    <div>
                        <img src={`/Uploads/${product.image}`} alt={product.titre} />
                    </div>
                    <p>{product.titre}</p>
                    <p>{product.description}</p>
                    <p>{(product.prix / 100).toLocaleString('fr-FR', { style: 'currency', currency: 'EUR' }).replace(/\s/g, '')}</p>

                    {product.personnalisation ? (
                        <div>
                            {product.namePersonnalisation.map((perso) => (
                                <p key={perso.id}>{perso.name}</p>
                            ))}
                        </div>
                    ) : (
                        <div>
                            <p>Pas de personnalisation disponible</p>
                        </div>
                    )}
                </div>
            ))}
        </div>
    )
}