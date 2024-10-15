## IfeelLucky test task

*Steps to run the project on your local environment:*
1. `git clone https://github.com/antonhub/ifeellucky.git`
2. `cd ifeellucky`
3. `composer install`
4. `composer run-script post-root-package-install`
5. `php artisan key:generate`
6. `npm install`
7. `npm run build`
8. `php artisan config:clear`
9. `php artisan migrate`
10. `php artisan serve`

<p>*Alternatively you can run the same commands as one line command:*</p>
```bash
git clone https://github.com/antonhub/ifeellucky.git && cd ifeellucky && composer install && composer run-script post-root-package-install && php artisan key:generate && npm install && npm run build && php artisan config:clear && php artisan migrate && php artisan serve
```

Now you can test IfeelLucky functionality in your browser by the <a href="http://localhost:8000/">*following link*</a>

<a href="https://github.com/antonhub/ifeellucky/commit/99d1b806a68c82fadbfaac56a06d80f1eae2958c">Это коммит для проверки кода</a>. В нем весь код, что я написал для требуемого функционала.
