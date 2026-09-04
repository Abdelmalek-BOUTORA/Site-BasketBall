<?php
require_once "connexion.php";

$entrainements = $conn->query(
    "SELECT * FROM entrainements ORDER BY date, heure"
);

$matchs = $conn->query(
    "SELECT * FROM matchs ORDER BY date, heure"
);

$news = $conn->query(
    "SELECT * FROM news ORDER BY date DESC"
);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CBA Basketball Club</title>
    <link rel="stylesheet" href="site.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;500;600;700;800;900&family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>

<section class="hero" id="accueil">

<header class="navbar">

    <div class="logo">
        <i class="fa-solid fa-basketball"></i>
        <div class="logo-text">
            <strong>CBA</strong>
            <span class="basketball-club">BASKETBALL CLUB</span>
        </div>
    </div>

    <nav class="nav-links">
        <a href="#accueil">ACCUEIL</a>
        <a href="#club">LE CLUB</a>
        <a href="#calendrier">CALENDRIER</a>
        <a href="#actualites">ACTUALITÉS</a>
    </nav>

    <div class="nav-buttons">
        <button class="player-btn">NOUS CONTACTER</button>
        <button class="join-btn">REJOINDRE LE CLUB</button>
    </div>

</header>

<div class="hero-content">
    <span class="hero-small">CBA BASKETBALL CLUB</span>

    <h1>L'ESPRIT D'EQUIPE,<br><span>LA PASSION DU JEU.</span></h1>

    <p>La passion du basket. L'envie de<br>progresser. La force du collectif.</p>

    <button class="hero-button">
        DÉCOUVRIR LE CLUB
        <i class="fa-solid fa-arrow-right"></i>
    </button>
</div>

</section>


<section id="club">

    <div id="gauche-club">

        <div class="texte-club">

            <span class="section-label">NOTRE IDENTITÉ</span>

            <h2>UN CLUB,<br><span>UNE HISTOIRE.</span></h2>

            <p>
                Depuis 1985, le CBA partage et transmet sa passion pour le basketball à travers les générations. Le club accompagne ses joueurs dans leur progression, tout en mettant l’accent sur le plaisir du jeu, l’esprit d’équipe et le respect.
            </p>

            <p>
                Au fil des années, joueurs, entraîneurs, bénévoles et familles ont contribué à faire grandir le club et à construire son identité. Aujourd’hui, le CBA continue d’avancer avec la même envie : former, rassembler et faire vivre le basketball dans un véritable esprit collectif.
            </p>

            <div class="club-stats">

                <div class="logo-club">
                    <div class="logo-club1">
                        <i class="fa-regular fa-calendar"></i>
                        <h3>1985</h3>
                    </div>
                    <span>ANNÉE DE CRÉATION</span>
                </div>

                <div class="logo-club">
                    <div class="logo-club1">
                        <i class="fa-solid fa-users"></i>
                        <h3>12</h3>
                    </div>
                    <span>ÉQUIPES</span>
                </div>

                <div class="logo-club">
                    <div class="logo-club1">
                        <i class="fa-solid fa-user"></i>
                        <h3>250+</h3>
                    </div>
                    <span>JOUEURS</span>
                </div>

                <div class="logo-club">
                    <div class="logo-club1">
                        <i class="fa-solid fa-crown"></i>
                        <h3>8</h3>
                    </div>
                    <span>COACHS</span>
                </div>

            </div>

        </div>

    </div>


    <div id="droite-club">

        <div class="images-club">

            <img src="images/club1.jpg" class="imgClub1">
            <img src="images/club2.jpg" class="imgClub2">
            <img src="images/club3.jpg" class="imgClub3">

        </div>

        <button class="bouton-club">
            EN SAVOIR PLUS
            <i class="fa-solid fa-arrow-right"></i>
        </button>

    </div>

</section>


<section id="calendrier">

    <div class="section-container">

        <span class="section-label">PROCHAINS RENDEZ-VOUS</span>

        <h2>CALENDRIER</h2>


        <div id="calendrier_cartes">


            <div class="entrainement">

                <h3>ENTRAÎNEMENTS</h3>

                <?php while ($entrainement = $entrainements->fetch_assoc()) { ?>

                    <div class="Entraînement">

                        <div class="icones-entrainements">

                            <i class="fa-regular fa-calendar"></i>

                            <i class="fa-regular fa-clock"></i>

                        </div>

                        <div class="texte-entrainements">

                            <strong>
                                <?= date("D, d M", strtotime($entrainement["date"])) ?>
                            </strong>

                            <span>
                                <?= htmlspecialchars($entrainement["heure"]) ?>
                            </span>

                            <p>
                                <?= htmlspecialchars($entrainement["equipes"]) ?>
                            </p>

                        </div>

                    </div>

                <?php } ?>

            </div>


            <div class="matches">

                <h3>PROCHAINES RENCONTRES</h3>

                <?php while ($match = $matchs->fetch_assoc()) { ?>

                    <div class="match">

                        <div class="team-logo">

                            <i class="fa-solid fa-basketball"></i>

                            <div>

                                <strong>CBA</strong>

                                <span>BASKETBALL CLUB</span>

                            </div>

                        </div>


                        <div class="match-info">

                            <strong>
                                <?= htmlspecialchars($match["categorie"]) ?>
                            </strong>

                            <span>
                                <?= date("D, d M", strtotime($match["date"])) ?>
                            </span>

                            <b>
                                <?= htmlspecialchars($match["heure"]) ?>
                            </b>

                            <small>
                                <?= htmlspecialchars($match["localisation"]) ?>
                            </small>

                        </div>


                        <div class="team-logo opponent">

                            <i class="<?= htmlspecialchars($match["logo_adverse"]) ?>"></i>

                            <div>

                                <strong>
                                    <?= htmlspecialchars($match["nom_adverse"]) ?>
                                </strong>

                                <span>BASKETBALL</span>

                            </div>

                        </div>

                    </div>

                <?php } ?>

            </div>


            <div class="support-card">

                <img src="images/calendrier1.jfif" alt="Basketball">

                <div class="support-overlay"></div>

                <div class="support-content">

                    <span>NOTRE PASSION</span>

                    <h3>
                        CHAQUE MATCH<br>
                        EST UNE NOUVELLE<br>
                        OPPORTUNITÉ.
                    </h3>

                    <p>
                        VENEZ NOUS<br>
                        SOUTENIR !
                    </p>

                </div>

                <button>
                    VOIR LE CALENDRIER
                    <i class="fa-solid fa-arrow-right"></i>
                </button>

            </div>


        </div>

    </div>

</section>


<section id="actualites">

    <div class="texte-news">

        <span class="section-label">RESTEZ INFORMÉS</span>

        <h2>
            DERNIÈRES <span>NEWS</span>
        </h2>

    </div>


    <div class="cartes-news">

        <?php while ($actualite = $news->fetch_assoc()) { ?>

            <div class="carte">

                <div class="news-image">

                    <img src="<?= htmlspecialchars($actualite["image_news"]) ?>">

                    <span>ACTUALITÉ</span>

                </div>


                <div class="news-content">

                    <h3>
                        <?= htmlspecialchars($actualite["titre"]) ?>
                    </h3>

                    <p>
                        <?= htmlspecialchars($actualite["description"]) ?>
                    </p>

                    <span class="date-news">
                        <?= date("d M Y", strtotime($actualite["date"])) ?>
                    </span>

                </div>

            </div>

        <?php } ?>

    </div>

</section>


<footer class="footer">

    <div class="footer-content">

        <div class="logo">

            <i class="fa-solid fa-basketball"></i>

            <div class="logo-text">

                <strong>CBA</strong>

                <span class="basketball-club">
                    BASKETBALL CLUB
                </span>

            </div>

        </div>

        <p>
            © 2026 CBA Basketball Club. Tous droits réservés.
        </p>

    </div>

</footer>


<div class="contact-overlay" id="contactOverlay">

    <div class="contact-popup">

        <button class="contact-close" id="contactClose">
            &times;
        </button>

        <span class="section-label">NOUS CONTACTER</span>

        <h2>
            PARLONS-<span>NOUS.</span>
        </h2>

        <p>
            Une question, une demande ou simplement envie d'échanger ? Retrouvez-nous ici.
        </p>


        <div class="contact-links">

            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=Abdelmalekboutora@gmail.com"
               target="_blank"
               class="contact-item">

                <i class="fa-solid fa-envelope"></i>

                <div>
                    <strong>E-MAIL</strong>
                    <span>Abdelmalekboutora@gmail.com</span>
                </div>

                <i class="fa-solid fa-arrow-right"></i>

            </a>


            <button class="contact-item" id="phoneCopy" type="button">

                <i class="fa-solid fa-phone"></i>

                <div>
                    <strong>TÉLÉPHONE</strong>
                    <span>+213 797 917 500</span>
                </div>

                <i class="fa-solid fa-copy"></i>

            </button>


            <a href="P343+RW7, Tizi Ouzou"
               target="_blank"
               class="contact-item">

                <i class="fa-solid fa-location-dot"></i>

                <div>
                    <strong>LOCALISATION</strong>
                    <span>Notre adresse</span>
                </div>

                <i class="fa-solid fa-arrow-right"></i>

            </a>


            <a href="https://www.facebook.com/"
               target="_blank"
               class="contact-item">

                <i class="fa-brands fa-facebook-f"></i>

                <div>
                    <strong>FACEBOOK</strong>
                    <span>Notre page Facebook</span>
                </div>

                <i class="fa-solid fa-arrow-right"></i>

            </a>

        </div>

    </div>

</div>


<div class="join-overlay" id="joinOverlay">

    <div class="join-popup">

        <button class="join-close" id="joinClose">
            &times;
        </button>

        <span class="section-label">REJOINDRE LE CLUB</span>

        <h2>
            INSCRIVEZ-<span>VOUS.</span>
        </h2>

        <p>
            Remplissez le formulaire pour envoyer votre demande d'inscription au CBA Basketball Club.
        </p>


        <form id="joinForm">

            <div class="form-row">

                <div class="form-group">

                    <label for="nom">NOM</label>

                    <input type="text"
                           id="nom"
                           name="nom"
                           placeholder="Votre nom"
                           required>

                </div>


                <div class="form-group">

                    <label for="prenom">PRÉNOM</label>

                    <input type="text"
                           id="prenom"
                           name="prenom"
                           placeholder="Votre prénom"
                           required>

                </div>

            </div>


            <div class="form-row">

                <div class="form-group">
                    <label for="ddn">DATE DE NAISSANCE</label>
                    <input type="date" id="ddn" name="date_de_naissance" required>
                </div>


                <div class="form-group">
                    <label for="telephone">TÉLÉPHONE</label>
                    <input type="tel" id="telephone" name="telephone" placeholder="+213 XX XX XX XX" required>
                </div>

            </div>


            <div class="form-group">

                <label>CERTIFICAT MÉDICAL</label>

                <label for="certificat" class="file-upload">

                    <i class="fa-solid fa-file-arrow-up"></i>

                    <div>

                        <strong>AJOUTER LE CERTIFICAT</strong>

                        <span>PDF, JPG ou PNG</span>

                    </div>

                </label>

                <input type="file" id="certificat" name="certificat_medical" accept=".pdf,.jpg,.jpeg,.png" required>

            </div>


            <button type="submit" class="join-submit">

                ENVOYER LA DEMANDE

                <i class="fa-solid fa-arrow-right"></i>

            </button>

        </form>

    </div>

</div>


<script src="site.js"></script>

</body>
</html>