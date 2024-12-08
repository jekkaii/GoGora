<!-- <?php
   include ('../GoGora-main/control/includes.php');
  
   ?> -->
   
   
   <!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>GoGora - Manage Priority Lane</title>
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
                   <h2>Manage Priority Lane</h2>
                   <a href="../manager/dashboard.php" class="back-link">Back to Dashboard</a>
               </header>
               <section class="accounts">
                   <div class="section-header">
                       <h3>Priority User Management</h3>
                   </div>
                   <table>
                       <thead>
                           <tr>
                               <th>Passenger</th>
                               <th>Username</th>
                               <th>Role</th>
                               <th>Type</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                       <tbody>
                           <tr>
                               <td>Jane Doe</td>
                               <td>janedoe</td>
                               <td>Student</td>
                               <td>Regular</td>
                               <td>
                                   <button class="action-btn edit">✏️</button>
                               </td>
                           </tr>
                       </tbody>
                   </table>
               </section>
               <section class="blacklisted">
                   <div class="section-header">
                       <h3>Ride Management</h3>
                   </div>
                   <table>
                       <thead>
                           <tr>
                               <th>Ride ID</th>
                               <th>Route</th>
                               <th>Schedule</th>
                               <th>Available Seats</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                       <tbody>
                           <tr>
                               <td>201</td>
                               <td>Bakakeng to Igorot Park</td>
                               <td>2024-11-25</td>
                               <td>2</td>
                               <td>
                                   <button class="action-btn edit">✏️</button>
                               </td>
                           </tr>
                       </tbody>
                   </table>
               </section>
           </main>
       </div>
   </body>
   </html>