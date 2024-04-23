import React, { useState, useEffect } from 'react';

import axios from 'axios';


import Stack from '@mui/material/Stack';
import Snackbar from '@mui/material/Snackbar';
import MuiAlert from '@mui/material/Alert';











// ALERT

const Alert = React.forwardRef(function Alert(props, ref) {
    return <MuiAlert elevation={6} ref={ref} variant="filled" {...props} />;
});

export default function HoverRating({ recetteId }) {
    const [value, setValue] = useState(null);
    const [comment, setComment] = useState('');
    const [showButton, setShowButton] = useState(true);
    const [ratingError, setRatingError] = useState('');
    const [commentError, setCommentError] = useState('');
    const [submittedRating, setSubmittedRating] = useState(null);
    const [formSubmitted, setFormSubmitted] = useState(false);
    const [avis, setAvis] = useState([]);
    const [open, setOpen] = useState(false);

    const [adress, setAdress] = useState('');
    const [codePostal, setCodePostal] = useState('');
    const [ville, setVille] = useState('');
    const [pays, setPays] = useState('');

    // JE RÉCUPÈRE LA DATA DE TOUS LES AVIS AVEC MON AXIOS GET

    useEffect(() => {
        axios
            .get(`/api/getAvis/${recetteId}`)
            .then((response) => {
                setAvis(response.data);
                console.log(avis);
            })
            .catch((error) => {
                console.error(error);
            });
    }, []);


    function handleRatingChange(event, newValue) {
        event.preventDefault();
        setValue(newValue);
        setRatingError('');
    }

    // JE RÉCUPÈRE LA DATA DU COMMENTAIRE

    function handleCommentChange(event) {
        setComment(event.target.value);
        setCommentError('');
    }

    // FERMER LA NOTIFICATION

    const handleCloseNotification = (event, reason) => {
        if (reason === 'clickaway') {
            return;
        }

        setOpen(false);

    };

    // JE VÉRIFIE QUE LA NOTE ET LE COMMENTAIRE ON ÉTAIT QUANTIFIÉ AVANT DE SUBMIT LE FORM

    function handleSubmit(e) {
        if (!value) {
            setRatingError('Vous devez attribuer une note.');
            return;
        }

        if (!comment) {
            setCommentError('Vous devez écrire un commentaire.');
            return;
        }
        if(comment && value) {
            e.preventDefault();

            setShowButton(false);
            setFormSubmitted(true);
            setOpen(true);

            axios
                .post(`/recette/${recetteId}`, {
                    recetteId: recetteId,
                    note: value,
                    description: comment,


                })
                .then((response) => {
                    const newAvis = {
                        id: recetteId,
                        Note: value,
                        Description: comment,


                    };

                    setAvis((prevAvis) => [...prevAvis, newAvis]);
                    setSubmittedRating(value);

                    setValue(null);
                    setComment('');
                    setShowButton(true);
                })
                .catch((error) => {
                    console.error(error);
                });
        }
    }

    // LORS DU SUBMIT JE RÉCUPÈRE UNE NOUVELLE FOIS L'ID DE LA RECETTE SELON L'AVIS

    function getAvisByRecetteId() {
        return avis;
    }


    // const avisByRecette = getAvisByRecetteId(recetteId);

    return (
        <div>
            <Box
                sx={{
                    width: '100%',
                    display: 'flex',
                    flexDirection: 'column',
                    alignItems: 'center',
                }}
            >
                {!formSubmitted &&  (
                    <Rating
                        value={value ? value : 1}
                        precision={0.5}
                        onChange={handleRatingChange}
                        emptyIcon={<StarIcon style={{ opacity: 0.55 }} fontSize="inherit" />}
                    />
                )}
                {ratingError && (
                    <Typography variant="caption" color="error">
                        {ratingError}
                    </Typography>
                )}
                <Box sx={{ mt: 2, width: '100%' }}>
                    {!formSubmitted && (
                        <TextField
                            label="Commentaire"
                            variant="outlined"
                            multiline
                            rows={4}
                            value={comment}
                            onChange={handleCommentChange}
                            fullWidth
                        />
                    )}
                </Box>
                {commentError && (
                    <Typography variant="caption" color="error">
                        {commentError}
                    </Typography>
                )}
                <Box sx={{ mt: 2 }}>
                    {showButton && !formSubmitted && (
                        <Button variant="contained" onClick={handleSubmit}>
                            Soumettre l'avis
                        </Button>
                    )}
                </Box>
                <Stack spacing={2} sx={{ width: '100%' }}>
                    <Snackbar open={open} autoHideDuration={3000} onClose={handleCloseNotification}>
                        <Alert onClose={handleCloseNotification} severity="success" sx={{ width: '100%' }}>
                            Merci d'avoir donné votre avis!
                        </Alert>
                    </Snackbar>
                </Stack>
            </Box>
            <div>
                <div className="titleAvis">
                    <h4>Tous vos avis:</h4>
                </div>
                {avis.map((avisItem) => (
                    <div key={avisItem.id} className="avis-item">
                        <StyledRating
                            name="highlight-selected-only"
                            value={avisItem.Note}
                            IconContainerComponent={IconContainer}
                            readOnly
                        />
                        <p> {avisItem.Description}</p>
                    </div>
                ))}
            </div>
        </div>
    );
}
