# GoGora Ride Reservation System 

## Overview
GoGora is a web application designed for managing and reserving rides, primarily targeting passengers, managers, and administrators.
This system allows users to view available rides, reserve seats, manage schedules, and handle payments. 
The application provides functionalities tailored to each user role, enhancing the overall ride experience.
Anyway, sana makapasa na tayo. 

## Table of Contents (To be Updated) 
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Usage](#usage)
- [File Structure](#file-structure)
- [Contributing](#contributing)
- [License](#license)

## Features
### Passengers
- View and reserve available rides, schedules, and seats.
- Filter rides by date and type.
- Pay in advance (GCash simulation) or manually at the time of the ride.
- Check estimated wait time before the scheduled ride.

### Managers
- Add, update, and remove rides (CRUD).
- View statistics on ride usage and passenger bookings.
- Manage blacklisted passengers.
- Create priority lanes for instructors, pregnant women, and disabled individuals.

### Administrators
- Perform all manager functionalities.
- Handle user accounts (CRUD).
- Conduct system maintenance and log errors.

## Technologies Used
- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Frameworks/Libraries**: (List any libraries or frameworks you used, e.g., jQuery, Bootstrap)

## Installation
To set up the project locally, follow these steps:

1. **Clone the repository**:
    ```bash
    git clone https://github.com/yourusername/RideReservationSystem.git
    cd RideReservationSystem
    ```

2. **Set up the database**:
   - Import the provided SQL schema into your MySQL database.
   - Update the database connection settings in `config.php` located in the `/admin/includes` directory.

3. **Start a local server**:
   - You can use tools like XAMPP, MAMP, or any other PHP server.

4. **Access the application**:
   - Open your browser and go to `http://localhost/RideReservationSystem/admin/index.php` for admin functionalities.
   - Access manager functionalities via `http://localhost/RideReservationSystem/manager/index.html`.
   - Access passenger functionalities via `http://localhost/RideReservationSystem/passenger/index.html`.

## Usage
- **Admin Panel**: Use this to manage users and perform system maintenance.
- **Manager Panel**: Log in to manage rides, view statistics, and handle blacklists.
- **Passenger Mobile UI**: Log in to reserve rides and check wait times.


