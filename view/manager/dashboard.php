<!-- <?php
   include ('../GoGora-main/control/includes.php');
  
   ?> -->
   
   
   <!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>GoGora - Manage Accounts</title>
       <link rel="stylesheet" href="../manager/css/dashboard.css">
   </head>
   <body>
       <div class="container">
           <nav class="sidebar">
               <div class="logo">
                   <div class="logo-image">Go</div>
                   <h1>GoGora</h1>
               </div>
               <div class="nav-title">MANAGER</div>
               <ul>
                   <li><a href="../manager/dashboard.php"><span class="icon">📊</span> Dashboard</a></li>
                   <li><a href="../manager/ride.php"><span class="icon">🚗</span> Ride Management</a></li>
                   <li><a href="#"><span class="icon">👥</span> Passenger Management</a></li>
                   <li><a href="../manager/route.php"><span class="icon">🛣️</span> Route Management</a></li>
                   <li><a href="#"><span class="icon">👤</span> Account Management</a></li>
                   <li><a href="#"><span class="icon">⭐</span> Priority Lane Management</a></li>
                   <li><a href="#"><span class="icon">📝</span> Reservations</a></li>
               </ul>
               <div class="logout">
                   <a href="#"><span class="icon">🚪</span> Logout</a>
               </div>
           </nav>
           <main class="content">
               <header>
                   <h2>Dashboard</h2>
               </header>
               <section class="accounts">
                   <div class="section-header">
                       <h3>Accounts</h3>
                   </div>
                   <table>
                       <thead>
                           <tr>
                               <th>Name</th>
                               <th>Username</th>
                               <th>Role</th>
                               <th>Type</th>
                           </tr>
                       </thead>
                       <tbody>
                           <tr>
                               <td>Jane Doe</td>
                               <td>janedoe</td>
                               <td>Passenger</td>
                               <td>Regular</td>
                           </tr>
                           <tr>
                               <td>John Doe</td>
                               <td>johndoe</td>
                               <td>Passenger</td>
                               <td>Regular</td>
                           </tr>
                           <tr>
                               <td>Juan Cruz</td>
                               <td>jcruz</td>
                               <td>Driver</td>
                               <td>Priority</td>
                           </tr>
                           <tr>
                               <td>Anna Mae</td>
                               <td>maean</td>
                               <td>Admin</td>
                               <td>Priority</td>
                           </tr>
                           <tr>
                               <td>Aiden Richards</td>
                               <td>aidenrich</td>
                               <td>Manager</td>
                               <td>Priority</td>
                           </tr>
                       </tbody>
                   </table>
               </section>
           </main>
       </div>
   </body>
   </html>