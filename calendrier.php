<?php
require_once "connexion.php";

$entrainements = $conn->query(
    "SELECT * FROM calendrier_entrainements ORDER BY date, heure"
);

$matchs = $conn->query(
    "SELECT * FROM calendrier_matchs ORDER BY date, heure"
);
?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Calendrier | CBA Basketball Club</title>

    <link rel="stylesheet" href="calendrier.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;500;600;700;800;900&family=Montserrat:wght@400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <style>

        .calendar-slider {
            display: flex;
            align-items: center;
            gap: 25px;
            width: 100%;
        }

        .training-list,
        .matches-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(2, auto);
            gap: 20px;
            flex: 1;
            min-width: 0;
        }

        .training-card,
        .match-card {
            display: none;
        }

        .training-card.active-card,
        .match-card.active-card {
            display: flex;
        }

        .slider-arrow {
            width: 50px;
            height: 50px;
            min-width: 50px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            background: rgba(255, 107, 0, 0.12);
            color: #fff;
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }

        .slider-arrow:hover {
            background: #ff6b00;
            border-color: #ff6b00;
        }

        @media (max-width: 1000px) {

            .training-list,
            .matches-list {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 650px) {

            .calendar-slider {
                gap: 10px;
            }

            .training-list,
            .matches-list {
                grid-template-columns: 1fr;
                grid-template-rows: repeat(6, auto);
            }

            .slider-arrow {
                width: 40px;
                height: 40px;
                min-width: 40px;
            }

        }

    </style>

</head>

<body>

<header class="navbar">

    <div class="logo">

        <i class="fa-solid fa-basketball"></i>

        <a href="index.php#accueil" class="logo-text">

            <strong>CBA</strong>

            <span class="basketball-club">
                BASKETBALL CLUB
            </span>

        </a>

    </div>

    <nav class="nav-links">

        <a href="index.php#accueil">
            ACCUEIL
        </a>

        <a href="club.html">
            LE CLUB
        </a>

        <a href="calendrier.php" class="active">
            CALENDRIER
        </a>

        <a href="index.php#actualites">
            ACTUALITÉS
        </a>

    </nav>

    <div class="nav-buttons">

        <button class="player-btn"
                onclick="window.location.href='index.php'">
            NOUS CONTACTER
        </button>

        <button class="join-btn"
                onclick="window.location.href='index.php#joinOverlay'">
            REJOINDRE LE CLUB
        </button>

    </div>

</header>


<!-- HERO -->

<section class="calendar-hero">

    <div class="hero-overlay"></div>

    <div class="hero-content">

        <span class="section-label">
            CBA BASKETBALL CLUB
        </span>

        <h1>
            NOS PROCHAINS<br>
            <span>RENDEZ-VOUS.</span>
        </h1>

        <p>
            Retrouvez l'ensemble des entraînements et des rencontres
            du CBA Basketball Club.
        </p>

    </div>

    <div class="hero-scroll">

        <span>
            FAIRE DÉFILER
        </span>

        <i class="fa-solid fa-arrow-down"></i>

    </div>

</section>


<!-- ENTRAÎNEMENTS -->

<section class="calendar-section">

    <div class="section-head">

        <div>

            <span class="section-label">
                01 — ENTRAÎNEMENTS
            </span>

            <h2>
                LES PROCHAINS<br>
                <span>ENTRAÎNEMENTS.</span>
            </h2>

        </div>

        <span class="section-number">
            01
        </span>

    </div>


    <div class="calendar-slider">

        <button class="slider-arrow slider-prev"
                onclick="changePage('training', -1)">

            <i class="fa-solid fa-chevron-left"></i>

        </button>


        <div class="training-list" id="training-list">

            <?php if ($entrainements && $entrainements->num_rows > 0): ?>

                <?php while ($entrainement = $entrainements->fetch_assoc()): ?>

                    <?php

                    $date = strtotime($entrainement["date"]);

                    $jour = strtoupper(date("D", $date));

                    $date_num = date("d", $date);

                    $mois = strtoupper(date("M", $date));

                    ?>

                    <article class="training-card">

                        <div class="training-date">

                            <strong>
                                <?= $date_num ?>
                            </strong>

                            <span>
                                <?= $jour ?><br>
                                <?= $mois ?>
                            </span>

                        </div>


                        <div class="training-icon">

                            <i class="fa-regular fa-clock"></i>

                        </div>


                        <div class="training-info">

                            <h3>
                                ENTRAÎNEMENT
                            </h3>

                            <span class="training-team">
                                <?= htmlspecialchars($entrainement["equipes"]) ?>
                            </span>

                            <div class="training-details">

                                <span>

                                    <i class="fa-regular fa-clock"></i>

                                    <?= htmlspecialchars($entrainement["heure"]) ?>

                                    <?php

                                    if (
                                        isset($entrainement["heure_fin"])
                                        && !empty($entrainement["heure_fin"])
                                    ) {
                                        echo " — " . htmlspecialchars($entrainement["heure_fin"]);
                                    }

                                    ?>

                                </span>


                                <?php if (
                                    isset($entrainement["lieu"])
                                    && !empty($entrainement["lieu"])
                                ): ?>

                                    <span>

                                        <i class="fa-solid fa-location-dot"></i>

                                        <?= htmlspecialchars($entrainement["lieu"]) ?>

                                    </span>

                                <?php endif; ?>

                            </div>

                        </div>


                        <div class="training-arrow">

                            <i class="fa-solid fa-arrow-right"></i>

                        </div>

                    </article>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="empty-state">

                    <i class="fa-regular fa-calendar-xmark"></i>

                    <p>
                        Aucun entraînement programmé pour le moment.
                    </p>

                </div>

            <?php endif; ?>

        </div>


        <button class="slider-arrow slider-next"
                onclick="changePage('training', 1)">

            <i class="fa-solid fa-chevron-right"></i>

        </button>

    </div>

</section>


<!-- RENCONTRES -->

<section class="matches-section">

    <div class="section-head">

        <div>

            <span class="section-label">
                02 — RENCONTRES
            </span>

            <h2>
                LES PROCHAINS<br>
                <span>MATCHS.</span>
            </h2>

        </div>

        <span class="section-number">
            02
        </span>

    </div>


    <div class="calendar-slider">

        <button class="slider-arrow slider-prev"
                onclick="changePage('match', -1)">

            <i class="fa-solid fa-chevron-left"></i>

        </button>


        <div class="matches-list" id="matches-list">

            <?php if ($matchs && $matchs->num_rows > 0): ?>

                <?php while ($match = $matchs->fetch_assoc()): ?>

                    <?php

                    $date = strtotime($match["date"]);

                    $jour = strtoupper(date("D", $date));

                    $date_num = date("d", $date);

                    $mois = strtoupper(date("M", $date));

                    ?>

                    <article class="match-card">

                        <div class="match-date">

                            <strong>
                                <?= $date_num ?>
                            </strong>

                            <span>
                                <?= $jour ?><br>
                                <?= $mois ?>
                            </span>

                        </div>


                        <div class="team team-cba">

                            <div class="team-logo">

                                <i class="fa-solid fa-basketball"></i>

                            </div>

                            <div class="team-name">

                                <strong>
                                    CBA
                                </strong>

                                <span>
                                    BASKETBALL CLUB
                                </span>

                            </div>

                        </div>


                        <div class="match-center">

                            <span class="category">
                                <?= htmlspecialchars($match["categorie"]) ?>
                            </span>

                            <strong class="match-time">
                                <?= htmlspecialchars($match["heure"]) ?>
                            </strong>

                            <span class="location">
                                <?= htmlspecialchars($match["localisation"]) ?>
                            </span>

                        </div>


                        <div class="vs">
                            VS
                        </div>


                        <div class="team team-opponent">

                            <div class="team-name">

                                <strong>
                                    <?= htmlspecialchars($match["nom_adverse"]) ?>
                                </strong>

                                <span>
                                    BASKETBALL
                                </span>

                            </div>


                            <div class="team-logo opponent-logo">

                                <?php if (!empty($match["logo_adverse"])): ?>

                                    <i class="<?= htmlspecialchars($match["logo_adverse"]) ?>"></i>

                                <?php else: ?>

                                    <i class="fa-solid fa-basketball"></i>

                                <?php endif; ?>

                            </div>

                        </div>

                    </article>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="empty-state">

                    <i class="fa-regular fa-calendar-xmark"></i>

                    <p>
                        Aucune rencontre programmée pour le moment.
                    </p>

                </div>

            <?php endif; ?>

        </div>


        <button class="slider-arrow slider-next"
                onclick="changePage('match', 1)">

            <i class="fa-solid fa-chevron-right"></i>

        </button>

    </div>

</section>


<!-- CTA -->

<section class="calendar-cta">

    <div class="cta-overlay"></div>

    <div class="cta-content">

        <span class="section-label">
            CBA BASKETBALL CLUB
        </span>

        <h2>
            CHAQUE MATCH.<br>
            <span>UNE NOUVELLE ÉNERGIE.</span>
        </h2>

        <p>
            Venez encourager le CBA et partager
            l'énergie du terrain avec nous.
        </p>

        <a href="index.php#actualites" class="cta-button">

            DÉCOUVRIR LE CLUB

            <i class="fa-solid fa-arrow-right"></i>

        </a>

    </div>

</section>


<!-- FOOTER -->

<footer class="footer">

    <div class="footer-content">

        <a href="index.php#accueil" class="logo">

            <i class="fa-solid fa-basketball"></i>

            <div class="logo-text">

                <strong>CBA</strong>

                <span class="basketball-club">
                    BASKETBALL CLUB
                </span>

            </div>

        </a>

        <p>
            © 2026 CBA Basketball Club. Tous droits réservés.
        </p>

    </div>

</footer>


<script>

    const currentPages = {
        training: 0,
        match: 0
    };


    function changePage(type, direction) {

        const listId = type === "training"
            ? "training-list"
            : "matches-list";

        const cardClass = type === "training"
            ? ".training-card"
            : ".match-card";

        const cards = document.querySelectorAll(
            `#${listId} ${cardClass}`
        );

        const cardsPerPage = 6;

        const totalPages = Math.ceil(
            cards.length / cardsPerPage
        );

        if (totalPages <= 1) {
            return;
        }

        currentPages[type] += direction;


        if (currentPages[type] < 0) {

            currentPages[type] = totalPages - 1;

        }


        if (currentPages[type] >= totalPages) {

            currentPages[type] = 0;

        }


        cards.forEach((card, index) => {

            const start =
                currentPages[type] * cardsPerPage;

            const end =
                start + cardsPerPage;


            if (index >= start && index < end) {

                card.classList.add("active-card");

            } else {

                card.classList.remove("active-card");

            }

        });

    }


    function initializeSlider(type) {

        const listId = type === "training"
            ? "training-list"
            : "matches-list";

        const cardClass = type === "training"
            ? ".training-card"
            : ".match-card";
        const cards = document.querySelectorAll(
            `#${listId} ${cardClass}`
        );
        cards.forEach((card, index) => {
            if (index < 6) {
                card.classList.add("active-card");
            }
        });
    }
    initializeSlider("training");
    initializeSlider("match");
</script>
</body>
</html>