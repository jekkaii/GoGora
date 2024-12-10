<!-- <?php
   include ('../GoGora-main/control/includes.php');
  
   ?> -->
   
   
   <!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>GoGora - Manage Routes</title>
       <link rel="stylesheet" href="../manager/css/styles.css">
   </head>
   <body>
       <div class="container">
           <nav class="sidebar">
               <div class="logo">
                   <h1>GoGora</h1>
               </div>
               <div class="nav-title">MANAGER</div>
               <ul>
                   <li><a href="../manager/dashboard.php"><span class="icon">📊</span> Dashboard</a></li>
                   <li><a href="../manager/ride.php"><span class="icon">🚗</span> Ride Management</a></li>
                   <li><a href="../manager/route.php"><span class="icon">🛣️</span> Route Management</a></li>
                   <li><a href="../manager/account.php"><span class="icon">👤</span> Account Management</a></li>
                   <li><a href="../manager/priority.php"><span class="icon">⭐</span> Priority Lane Management</a></li>
                   <li><a href="../manager/reservations.php"><span class="icon">📝</span> Reservations</a></li>
               </ul>
               <div class="logout">
                   <a href="#"><span class="icon">🚪</span> Logout</a>
               </div>
           </nav>
           <main class="content">
               <header>
                   <h2>Manage Routes</h2>
                   <a href="../manager/dashboard.php" class="back-link">Back to Dashboard</a>
               </header>
               <section class="accounts">
                   <div class="section-header">
                       <h3>Routes</h3>
                       <button class="add-user"><a href="../manager/addRide.php">Add Route</a></button>
                   </div>
                   <table>
                       <thead>
                           <tr>
                               <th>Plate No.</th>
                               <th>Type</th>
                               <th>From:</th>
                               <th>To:</th>
                               <th>Schedule</th>
                               <th>Seats</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                       <tbody>
                           <tr>
                               <td>ABC1234</td>
                               <td>Jeepney</td>
                               <td>Igorot Park</td>
                               <td>Bakakeng</td>
                               <td>10:00 am to 11:00 am</td>
                               <td>22</td>
                               <td>
                                   <button class="action-btn edit">✏️</button>
                                   <button class="action-btn delete">🗑️</button>
                               </td>
                           </tr>
                       </tbody>
                   </table>
               </section>
           </main>
       </div>
   </body>
   </html>