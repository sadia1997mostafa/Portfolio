<?php 
include 'backend/db.php'; 

// Fetch all skills
$result = $conn->query("SELECT * FROM skills ORDER BY Id DESC"); 
$skills = [];
while ($row = $result->fetch_assoc()) {
    $skills[] = $row;
}

// helper to safely text
function h($s){ return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Skills</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    /* ====== PAGE / LAYOUT ====== */
    :root{
      --neon:#00f6ff;
      --neon-soft:rgba(0,246,255,.55);
      --bg-1:#000610;
      --bg-2:#00131d;
      --card:#0b0f14;
      --text:#e7fbff;
      --muted:#a9c7cf;
    }
    *{box-sizing:border-box}
    html,body{margin:0;padding:0;background: radial-gradient(1200px 800px at 50% 0%, #001a26 0%, var(--bg-1) 50%, #000 100%); color:var(--text); font-family:system-ui,-apple-system,Segoe UI,Roboto,Inter,Arial,sans-serif;}
    .container{width:min(1100px,92vw); margin:40px auto;}

    .section-header{ text-align:center; margin-bottom:28px;}
    .section-title{ font-size:34px; margin:0; letter-spacing:.5px; color:var(--neon); text-shadow:0 0 18px var(--neon), 0 0 36px var(--neon); }
    .title-underline{ width:72px; height:3px; margin:12px auto 0; background:var(--neon); box-shadow:0 0 18px var(--neon); border-radius:2px;}

    /* ====== GRID ====== */
    .skills-grid{
      display:grid; gap:18px; margin:28px 0 42px;
      grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
    }
    .skill-card{
      background:linear-gradient(180deg, #0c151c 0%, #0a0f15 100%);
      border:1px solid rgba(0,246,255,.25);
      border-radius:14px; padding:18px; text-align:center;
      box-shadow: 0 0 24px rgba(0,246,255,.15) inset, 0 0 24px rgba(0,246,255,.12);
      transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }
    .skill-card:hover{
      transform: translateY(-4px);
      border-color: var(--neon);
      box-shadow: 0 0 36px rgba(0,246,255,.28), 0 0 18px rgba(0,246,255,.28) inset;
    }
    .skill-image img{ width:58px; height:58px; object-fit:contain; filter: drop-shadow(0 0 8px var(--neon-soft)); }
    .skill-name{ margin:10px 0 4px; font-size:18px; color:var(--text)}
    .skill-level{ font-size:13px; color:var(--muted)}

    /* ====== CYBER TREE WRAP ====== */
    .tree-wrap{
      position:relative; border-radius:18px; overflow:hidden;
      padding:18px; background: radial-gradient(900px 600px at 50% 30%, #001e2a 0%, #000a12 55%, #000 100%);
      border:1px solid rgba(0,246,255,.22);
      box-shadow: 0 0 40px rgba(0,246,255,.18), inset 0 0 60px rgba(0,246,255,.08);
    }
    /* shimmering starfield */
    .tree-wrap:before,
    .tree-wrap:after{
      content:""; position:absolute; inset:-20%;
      background:
        radial-gradient(2px 2px at 20% 30%, rgba(255,255,255,.9) 40%, transparent 41%) repeat,
        radial-gradient(1.5px 1.5px at 60% 70%, rgba(255,255,255,.8) 45%, transparent 46%) repeat,
        radial-gradient(1.8px 1.8px at 80% 20%, rgba(255,255,255,.9) 40%, transparent 41%) repeat;
      background-size: 220px 220px, 260px 260px, 200px 200px;
      filter: drop-shadow(0 0 6px rgba(0,246,255,.6));
      animation: twinkle 9s linear infinite;
      opacity:.45; pointer-events:none;
    }
    .tree-wrap:after{ animation: twinkle2 12s linear infinite; opacity:.30; }
    @keyframes twinkle{ 
      0%{ transform:translate3d(0,0,0) scale(1) rotate(0deg)}
      50%{ transform:translate3d(-2%, -3%, 0) scale(1.02) rotate(0.5deg)}
      100%{ transform:translate3d(0,0,0) scale(1) rotate(0deg)}
    }
    @keyframes twinkle2{ 
      0%{ transform:translate3d(0,0,0) scale(1) rotate(0deg)}
      50%{ transform:translate3d(3%, 2%, 0) scale(1.03) rotate(-0.6deg)}
      100%{ transform:translate3d(0,0,0) scale(1) rotate(0deg)}
    }

    /* force SVG size so it can't collapse */
    .tree-stage{
      width:100%; height:720px; display:block; border-radius:12px;
      outline:1px solid rgba(0,246,255,.12);
      background: radial-gradient(600px 420px at 50% 40%, rgba(0,30,40,.35), transparent 60%);
    }
    svg{ width:100%; height:100%; display:block }

    /* ====== SVG STYLES / ANIMATIONS ====== */
    .trunk{
      stroke:var(--neon); stroke-linecap:round; 
      filter:url(#glowStrong);
      animation: trunkPulse 3s ease-in-out infinite alternate;
    }
    @keyframes trunkPulse { from{ stroke-width:14; opacity:.75 } to{ stroke-width:18; opacity:1 } }

    .root, .branch {
      stroke:var(--neon); fill:none; filter:url(#glowSoft);
      stroke-linecap:round;
    }
    .root{ stroke-width:4; opacity:.75; stroke-dasharray: 5 14; animation: flow 5s linear infinite; }
    .root.thin{ stroke-width:3; opacity:.55; stroke-dasharray: 3 12; animation-duration: 6.5s; }
    .root.hair{ stroke-width:2; opacity:.45; stroke-dasharray: 2 10; animation-duration: 7.5s; }
    @keyframes flow { to { stroke-dashoffset: -160; } }

    .branch{ stroke-width:3; opacity:.85; }
    .branch.glow { filter:url(#glowStrong) }

    .node circle{
      fill:#0b0f14; stroke:var(--neon); stroke-width:3.5; 
      filter:url(#glowStrong);
      transition: transform .25s ease, stroke .25s ease, stroke-width .25s ease, opacity .25s ease;
      animation: nodePulse 2.4s ease-in-out infinite alternate;
    }
    @keyframes nodePulse { from{ opacity:.85; stroke-width:3.5 } to{ opacity:1; stroke-width:4.5 } }
    .node:hover circle{ transform: scale(1.12); stroke:#ffe600; }
    .node text{ font-size:13px; fill:var(--neon); text-shadow:0 0 10px var(--neon); pointer-events:none; }

    /* fallback if an image fails */
    .node .fallback-icon{ fill:#071018; stroke:var(--neon); stroke-width:2 }

    /* small note when no skills */
    .empty-note{ text-align:center; color:var(--muted); margin:18px 0 6px; }
  </style>
</head>
<body>
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">Skills</h2>
      <div class="title-underline"></div>
    </div>

    <!-- GRID VIEW -->
    <div class="skills-grid">
      <?php if (count($skills) === 0): ?>
        <div class="empty-note" style="grid-column:1/-1">No skills found.</div>
      <?php else: foreach ($skills as $s): ?>
        <div class="skill-card">
          <div class="skill-image"><img src="<?=h($s['Image_url'])?>" alt="icon"></div>
          <div class="skill-content">
            <div class="skill-name"><?=h($s['Skill'])?></div>
            <div class="skill-level"><?=h($s['Level'])?></div>
          </div>
        </div>
      <?php endforeach; endif; ?>
    </div>

    <!-- CYBER / NEURON TREE -->
    <div class="tree-wrap">
      <svg class="tree-stage" viewBox="0 0 800 720" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">

        <!-- ===== FILTERS (glow) ===== -->
        <defs>
          <filter id="glowSoft" x="-50%" y="-50%" width="200%" height="200%">
            <feGaussianBlur stdDeviation="3.5" result="b1"/>
            <feMerge><feMergeNode in="b1"/><feMergeNode in="SourceGraphic"/></feMerge>
          </filter>
          <filter id="glowStrong" x="-60%" y="-60%" width="220%" height="220%">
            <feGaussianBlur stdDeviation="6.5" result="b2"/>
            <feMerge><feMergeNode in="b2"/><feMergeNode in="SourceGraphic"/></feMerge>
          </filter>
        </defs>

        <!-- ===== TRUNK (big, centered) ===== -->
        <!-- Main Trunk (connects roots at 750 to branch base at 350) -->
<line x1="400" y1="750" x2="400" y2="350" 
      stroke="#0ff" stroke-width="14" 
      stroke-linecap="round" filter="url(#glow)"/>


        <!-- ===== ROOTS (many neuron-like) ===== -->
        <!-- left cluster -->
        <path class="root" d="M400 750 C 360 690, 320 720, 270 710" />
        <path class="root thin" d="M400 750 C 350 680, 290 705, 230 700" />
        <path class="root hair" d="M400 750 C 365 665, 315 680, 280 675" />
        <path class="root hair" d="M400 750 C 370 700, 330 740, 300 760" />
        <path class="root thin" d="M400 750 C 330 690, 260 735, 200 730" />
        <!-- right cluster -->
        <path class="root" d="M400 750 C 440 690, 480 720, 530 710" />
        <path class="root thin" d="M400 750 C 450 680, 510 705, 570 700" />
        <path class="root hair" d="M400 750 C 435 665, 485 680, 520 675" />
        <path class="root hair" d="M400 750 C 430 700, 470 740, 500 760" />
        <path class="root thin" d="M400 750 C 470 690, 540 735, 600 730" />
        <!-- deep fibers -->
        <path class="root hair" d="M400 750 C 395 690, 400 730, 395 760" />
        <path class="root hair" d="M400 750 C 405 700, 410 740, 420 770" />

        <!-- ===== BRANCHES + NODES (dynamic from PHP) ===== -->
        <?php
          $N = count($skills);
          // center of branching (top of trunk)
          $cx = 400; $cy = 360;
          // place nodes along an upper arc (angles -170° to -10° = top hemisphere)
          if ($N <= 1) {
              $angles = [-90];
          } else {
              $angles = [];
              $start = -170; $end = -10;
              for ($i=0; $i<$N; $i++){
                  $angles[] = $start + ($end - $start) * ($i/($N-1));
              }
          }
          // two ring radii if there are many nodes
          $rOuter = 200; $rInner = 150;
        ?>

        <?php for ($i=0; $i<$N; $i++):
              $a = deg2rad($angles[$i]);
              // alternate outer/inner radii for a denser canopy
              $r = ($i % 2 === 0) ? $rOuter : $rInner;
              $nx = $cx + cos($a) * $r;
              $ny = $cy + sin($a) * $r;

              // curve control point (bend upwards, bias sideways)
              $midX = ($cx + $nx)/2;
              $midY = ($cy + $ny)/2 - 90;
              if ($nx < $cx) $midX -= 60; else $midX += 60;

              // data
              $label = h($skills[$i]['Skill']);
              $icon  = h($skills[$i]['Image_url']);
        ?>
          <!-- branch -->
          <path class="branch" d="M <?=$cx?> <?=$cy?> Q <?=$midX?> <?=$midY?>, <?=$nx?> <?=$ny?>" />
          <!-- subtle extra glow -->
          <path class="branch glow" d="M <?=$cx?> <?=$cy?> Q <?=$midX?> <?=$midY?>, <?=$nx?> <?=$ny?>" opacity=".25"/>

          <!-- node -->
          <g class="node">
            <circle cx="<?=$nx?>" cy="<?=$ny?>" r="34"/>
            <!-- icon (with xlink for older browsers) -->
            <image href="<?=$icon?>" xlink:href="<?=$icon?>" x="<?=$nx-18?>" y="<?=$ny-18?>" width="36" height="36" />
            <!-- fallback if image fails -->
            <g class="fallback" style="display:none">
              <circle class="fallback-icon" cx="<?=$nx?>" cy="<?=$ny?>" r="16"/>
            </g>
            <text x="<?=$nx?>" y="<?=$ny+52?>" text-anchor="middle"><?=$label?></text>
          </g>
        <?php endfor; ?>

        <?php if ($N===0): ?>
          <text x="400" y="300" text-anchor="middle" fill="rgba(255,255,255,.7)" style="font-size:15px">Add skills to see the tree light up ✨</text>
        <?php endif; ?>

      </svg>
    </div>
  </div>

  <script>
    // If an icon fails to load, show the fallback dot
    document.querySelectorAll('image').forEach(img=>{
      img.addEventListener('error', ()=>{
        const g = img.parentNode;
        const fb = g.querySelector('.fallback');
        if (fb) fb.style.display = 'block';
        img.remove();
      });
    });
  </script>
</body>
</html>
