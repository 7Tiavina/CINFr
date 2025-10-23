<footer style="background: radial-gradient(circle at top left, #0a5cff, #0430b3); color: #fff; padding: 50px 60px; font-family: 'Poppins', sans-serif; box-shadow: 0 -3px 15px rgba(0,0,0,0.3);">
  <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 40px;">
    
    <!-- Logo Section -->
    <div style="flex: 1; min-width: 220px; text-align: center;">
      <picture>
        <source srcset="images/logoreverse.webp" type="image/webp">
        <img src="images/logoreverse.png" alt="Logo CINFr" style="max-width: 160px; margin-bottom: 20px; filter: drop-shadow(0 0 6px rgba(255,255,255,0.2));">
      </picture>
      <p style="font-size: 13px; margin-top: 10px; color: #fff;">© 2025 CINFr — Tous droits réservés</p>
    </div>

    <!-- Links Section -->
    <div style="flex: 1; min-width: 200px; text-align: center;">
      <h3 style="font-size: 17px; margin-bottom: 15px; letter-spacing: 0.5px; text-transform: uppercase;">Liens utiles</h3>
      <ul style="list-style: none; padding: 0; margin: 0;">
        <li style="margin: 12px 0;">
          <a href="{{ route('contact') }}" style="color: white; text-decoration: none; font-size: 15px; position: relative; transition: all 0.3s;">
            Contact
          </a>
        </li>
        <li style="margin: 12px 0;">
          <a href="{{ route('mentions') }}" style="color: white; text-decoration: none; font-size: 15px; position: relative; transition: all 0.3s;">
            Mentions légales & CGV
          </a>
        </li>
        <li style="margin: 12px 0;">
          <a href="{{ route('remboursement') }}" style="color: white; text-decoration: none; font-size: 15px; position: relative; transition: all 0.3s;">
            Politique de remboursement
          </a>
        </li>
        <li style="margin: 12px 0;">
          <a href="{{ route('login') }}" style="color: white; text-decoration: none; font-size: 15px; position: relative; transition: all 0.3s;">
            <i class="icon ion-md-lock" style="margin-right: 5px;"></i> Admin Login
          </a>
        </li>
      </ul>
    </div>

    <!-- Information Section -->
    <div style="flex: 2; min-width: 320px; text-align: justify;">
      <h3 style="font-size: 16px; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Informations</h3>
      <p style="font-size: 10.5px; line-height: 1.8; color: rgba(255,255,255,0.85);">
        Le site et les services sont fournis à titre privé uniquement et ne correspondent en aucune manière à une mission de service public qui lui aurait été déléguée par une quelconque administration publique ou collectivité territoriale.  
        Vous pouvez effectuer vos démarches gratuitement sur 
        <a href="https://service-public.fr" style="color: #aee0ff; text-decoration: underline; transition: 0.3s;">service-public.fr</a>.
      </p>
    </div>
  </div>

  <style>
    footer a:hover {
      color: #aee0ff !important;
      text-shadow: 0 0 6px rgba(255,255,255,0.4);
      transform: translateY(-2px);
    }
    footer h3 {
      font-weight: 500;
      border-bottom: 1px solid rgba(255,255,255,0.25);
      display: inline-block;
      padding-bottom: 4px;
    }
    @media (max-width: 768px) {
      footer {
        text-align: center;
        padding: 40px 20px;
      }
      footer div {
        text-align: center !important;
      }
    }
  </style>
</footer>
