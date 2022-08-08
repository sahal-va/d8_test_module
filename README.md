# Drupal 8 Test
This is a Drupal8 module sparingly built for the purposes of test.

Once the local environment has successfully started, install the subscription module.


### Prerequisites
1. Clone the module inside your drupal_web_root/modules/custom
```bash
# Clone
 git clone https://github.com/sahal-va/d8_test_module.git
```

2. Install the module either by using drush or Admin UI.
```bash
# Enable module
 drush pm:enable subscription
```

After enabling, 

i.   Product, Contact, Company, Subscription entities will be created.

     You can add/view entities under Admin > Content section

ii.  Views with company name as contextual filter will be created under path domain-name/subscriptions/company-name

iii. Custom menu will be created in admin toolbar "All Users"

iv.  For each contact entity added, a drupal user will be created with disabled status. Once the subscription is active, user will be enabled.

     username and password will be the username part of the email used to create contact entity.
     eg: - If john.test@gmail.com is the contact email, user will be created with credentials john.test/john.test

    Note: user accounts will be automatically activated/deactivated based on their subscription status.