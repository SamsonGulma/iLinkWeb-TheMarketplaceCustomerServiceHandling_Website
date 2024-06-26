# ILINK E-Commers

A brief description of what the project does.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Configuration](#configuration)
- [Features](#features)
- [Contributing](#contributing)
- [Testing](#testing)
- [License](#license)
- [Credits](#credits)
- [Contact](#contact)

## Installation

Instructions on how to install and set up the project.

###### for Kali linux user

sudo apt-get update
sudo apt-get install php

sudo yum install php

php -v

git clone https://github.com/SamsonGulma/iLinkWeb-TheMarketplaceCustomerServiceHandling_Website.git
cd iLinkWeb-TheMarketplaceCustomerServiceHandling_Website/[FINAL PROJECTS/php](https://github.com/SamsonGulma/iLinkWeb-TheMarketplaceCustomerServiceHandling_Website/tree/main/FINAL%20PROJECTS/php "This path skips through empty directories")

composer install

cp .env.example .env

###### for window user

1. Install PHP
   First, download PHP from php.net and follow these steps:

Download the PHP installer for Windows.

Run the installer and follow the installation wizard.

Add PHP to your system PATH:

Open the Control Panel.
Go to System and Security -> System -> Advanced system settings -> Environment Variables.
Under "System Variables," find the Path variable and click "Edit."
Add the path to your PHP installation directory (e.g., C:\php) to the list of paths. Make sure to separate it from existing paths with a semicolon (;).
Verify the installation by opening a command prompt and typing:

cmd
Copy code
php -v
2. Clone the Repository
Clone the project repository from GitHub:

## Usage

### For Sellers:

##### Create Seller Account:

Sellers need to create an account on the platform.
They provide necessary information such as name, email, contact details, and possibly business information.

**Seller Verification:**

Before selling products, sellers undergo a verification process by the admin.
Admin reviews and validates seller information to ensure compliance with platform standards.

**Post Products:**

Once verified, sellers can log in to their account.
They can post products for sale by providing product details such as name, description, price, and images.
Sellers may also categorize products and set shipping options.
**Manage Products:**

Sellers can manage their listed products, including editing details, updating quantities, or removing listings as needed.
They can view sales analytics and order history related to their products.

##### For Buyers:

**Create Buyer Account:**

Buyers sign up for an account on the platform.
They input personal information like name, email, and address for shipping.
**Browse Products:**

Buyers can browse through the platform's catalog of products.
They can use search and filtering options to find specific products of interest.
**Add to Cart:**

Interested buyers can add products to their shopping cart.
They can adjust quantities, view total costs, and proceed to checkout.
**Checkout and Payment:**

At checkout, buyers review their cart items and total costs.
They select a payment method (e.g., credit card, PayPal).
Buyers enter payment details securely.
Order Confirmation:

After successful payment, buyers receive an order confirmation with details like order number and estimated delivery date.
They can track their order status through their account.

## Configuration

To set up and configure the platform, follow these steps:

1. **PHP Installation**
   Ensure PHP is installed on your system. You can download PHP from php.net and follow the installation instructions for your operating system.
2. C**lone the Repository**
   Clone the repository to your local machine using Git:
3. **Database Configuration**

Configure your database settings. Copy the `.env.example` file to `.env` and update the following database variables:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

<pre><div class="dark bg-gray-950 rounded-md border-[0.5px] border-token-border-medium"><div class="flex items-center relative text-token-text-secondary bg-token-main-surface-secondary px-4 py-2 text-xs font-sans justify-between rounded-t-md"><span></span></div></div></pre>

## Features

##### Seller Features:

1. **Account Creation and Login:**

   - Sellers can create accounts and login securely.
2. **Product Management:**

   - Sellers can add, edit, and delete products they wish to sell.
   - Products can include details such as name, description, price, and images.
3. **Validation by Admin:**

   - Sellers must undergo validation by an admin before they can start selling.
   - Admin approval ensures product quality and seller credibility.

#### Buyer Features:

1. **Account Creation and Login:**

   - Buyers can create accounts and login securely.
2. **Product Browsing:**

   - Buyers can browse through a list of available products.
3. **Cart Management:**

   - Buyers can add products to their shopping cart for later purchase.
4. **Checkout and Payment:**

   - Buyers can proceed to checkout and complete purchases securely.

#### Admin Features:

1. **Seller Validation:**

   - Admins have the authority to validate sellers before they can list products for sale.
   - Validation ensures seller credibility and adherence to platform standards.
2. **Product Management:**

   - Admins can view, edit, and delete products listed on the platform.
   - This ensures quality control and compliance with platform guidelines.

## License

This project is licensed under the MIT License.

**iLink Team**
The iLink team retains all rights to this project and its codebase unless otherwise specified. Contributions made to this project are subject to the terms of the MIT License.
