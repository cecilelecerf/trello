<div class="pages stats">
    <h3 class="mb-3">Statistiques</h3>
    <legend class="mb-5">Vous êtes actuellement sur la page des statistiques de l'application. Ici, vous pouvez trouver des informations intéressantes sur l'utilisation de l'application. Par exemple, vous pouvez voir le nombre de workspaces disponibles ainsi que les utilisateurs les plus actifs. Utilisez ces données pour optimiser votre expérience sur l'application Trello !</legend>
    <article class="mb-5">
        <h4>Les utilisateurs les plus actifs sont :</h4>
        <ol class="list-group list-group-flush list-group-numbered">
            <?php foreach ($topUsers as $user):?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <!-- Nom de la personne -->
                    <?= h($user->user->username) ?>
                    <!-- nombre de workspace -->
                    <span class="badge bg-primary rounded-pill">14</span>
                    
                </li>
            <?php endforeach ?>
            </ol>
    </article>
    <section>
        <article class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                <img src="../../../UML/trello/img/naassom-azevedo-Q_Sei-TqSlc-unsplash.jpg" class="img-fluid rounded-start" alt="...">
                </div>
                    <div class="card-body col-md-8">
                        <h5 class="card-title"><span class="text-primary"><i class="fa-solid fa-users"></i> <?=$users->count()?></span> utilisateurs</h5>
                        <p class="card-text">Notre application Trello compte actuellement <?=$users->count()?> utilisateurs. Enfin, nous avons remarqué que les utilisateurs ont tendance à passer plus de temps sur la création de tâches que sur la mise à jour de celles existantes.</p>
                    </div>
            </div>
        </article>
        <article class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                <img src="../../../UML/trello/img/shridhar-gupta-dZxQn4VEv2M-unsplash.jpg" class="img-fluid rounded-start" alt="...">
                </div>
                    <div class="card-body col-md-8">
                        <h5 class="card-title"><span class="text-primary"><i class="fa-solid fa-map"></i> <?=$workspaces->count()?></span> espace de travail</h5>
                        <p class="card-text">Il est intéressant de noter que votre application compte actuellement un total de <?=$workspaces->count()?> workspaces créés. Cela montre à quel point l'application est en demande et à quel point elle est utile pour les utilisateurs qui cherchent à organiser leur travail et leur vie professionnelle. Avec une telle croissance dans le nombre de workspaces créés, il est clair que l'application continue d'avoir un impact significatif sur la façon dont les gens travaillent et communiquent en ligne.</p>
                    </div>
            </div>
        </article>
        <article class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                <img src="../../../UML/trello/img/ux-indonesia-w00FkE6e8zE-unsplash.jpg" class="img-fluid rounded-start" alt="...">
                </div>
                    <div class="card-body col-md-8">
                        <h5 class="card-title"><span class="text-primary"><i class="fa-solid fa-tags"></i> <?=$categories->count()?></span> catégories</h5>
                        <p class="card-text">Actuellement, votre application Trello compte un total de <?=$categories->count()?> catégories différentes. Ces catégories permettent d'organiser les cartes en fonction de leur contenu et de leur importance, ce qui facilite la gestion et la recherche d'informations. En ajoutant de nouvelles catégories au fur et à mesure que votre application évolue, vous pourrez continuer à améliorer l'efficacité de votre flux de travail et à maximiser la productivité de votre équipe.</p>
                    </div>
            </div>
        </article>
        <article class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                <img src="../../../UML/trello/img/ux-indonesia-w00FkE6e8zE-unsplash.jpg" class="img-fluid rounded-start" alt="...">
                </div>
                    <div class="card-body col-md-8">
                        <h5 class="card-title"><span class="text-primary"><i class="fa-solid fa-pen-to-square"></i> <?=$cards->count()?></span> cartes</h5>
                        <p class="card-text">Le nombre de cartes présentes sur votre Trello est un indicateur important de l'activité de votre équipe. En effet, plus il y a de cartes, plus cela signifie que des tâches sont en cours de réalisation ou ont été achevées. Cela peut être un bon indicateur de productivité. Gardez donc un œil sur le nombre de cartes présentes sur votre tableau Trello pour vous assurer que votre équipe est bien sur la bonne voie.</p>
                    </div>
            </div>
        </article>
    </section>

</div>
