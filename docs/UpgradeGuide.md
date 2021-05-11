# Upgrading from 3.* to 4.*

The upgrade guide from 2.* to 3.* can be found [here](https://github.com/neighborhoods/KojoWorkerDecoratorComponent/blob/3.0.0/docs/UpgradeGuide.md).

In version 4 all components have been versioned. The structure is refactored causing changes in namespaces, template paths and fabricated method names.

Common (not decorator specific) code has been moved from `src` to `src/WorkerDecorationV1`.

Decorators have been moved from `src/Worker` into their own versioned directory. For example `src/Worker/CrashedThresholdDecorator.php` is now in `src/WorkerDecoratorionV1Decorators/CrashedThresholdV1/CrashedThresholdDecorator.php` along with accompanying files.

Buphalo templates have been reorganized. `template-tree/V1` is renamed to `template-tree/BuphaloV1`. `Decorator` templates have been moved into `WorkerDecorationV1/DecoratorV1` and `Worker` templates into `WorkerDecorationV1/WorkerV1`.

Require version 4 using composer.
```bash
composer require neighborhoods/kojo-worker-decorator-component:^4
```
Some products run the buphalo script as part of composer's post-install or post-update script. Composer won't be able to complete the update since the buphalo files changed. Temporary exclude the buphalo script from composer scripts.

To quickly switch to the new file structure run the following regex inside your source and possibly test folders.
```bash
cd src

# fix namespaces
grep -RiIl 'KojoWorkerDecoratorComponent\\Worker' | xargs sed -i 's/KojoWorkerDecoratorComponent\\Worker\\\([a-zA-Z0-9]\+\)Decorator/KojoWorkerDecoratorComponent\\WorkerDecorationV1Decorators\\\1V1\\\1Decorator/g'
grep -RiIl 'KojoWorkerDecoratorComponent\\Worker' | xargs sed -i 's/KojoWorkerDecoratorComponent\\\(Worker[^D]\)/KojoWorkerDecoratorComponent\\WorkerDecorationV1\\\1/g'
grep -RiIl 'KojoWorkerDecoratorComponent\\Connection' | xargs sed -i 's/KojoWorkerDecoratorComponent\\Connection/KojoWorkerDecoratorComponent\\WorkerDecorationV1\\Connection/g'

# fix getters and setters from fabricated aware traits
grep -RiIl 'etWorker' | xargs sed -i 's/etWorker\([a-zA-Z0-9]\+\)Decorator/etWorkerDecorationV1Decorators\1V1\1Decorator/g'
grep -RiIl 'etWorker' | xargs sed -i 's/et\(Worker[^D]\)/etWorkerDecorationV1\1/g'

#fix buphalo templates
grep -RiIl 'template: KojoWorkerDecoratorComponent\/Decorator\/PrimaryActorName' | grep \.buphalo\.v1\.fabrication\.yml$ | xargs sed -i 's/template: KojoWorkerDecoratorComponent\/Decorator\/PrimaryActorName/template: KojoWorkerDecoratorComponent\/WorkerDecorationV1\/DecoratorV1\/PrimaryActorName/g'
grep -RiIl 'template: KojoWorkerDecoratorComponent\/Worker\/PrimaryActorName' | grep \.buphalo\.v1\.fabrication\.yml$ | xargs sed -i 's/template: KojoWorkerDecoratorComponent\/Worker\/PrimaryActorName/template: KojoWorkerDecoratorComponent\/WorkerDecorationV1\/WorkerV1\/PrimaryActorName/g'

cd ..
# do the same in the test folder
```
Review the changes after running the commands. Having a clean git repository will make it easier.

Buphalo fabricated files, but before that update the path to the template tree.
```bash
sed -i 's/\(vendor\/neighborhoods\/kojo-worker-decorator-component\/template-tree\/\)V1/\1BuphaloV1/g' bin/buphalo
```
If you had the buphalo script as part of the composer scripts, enable them. Run `composer dump-autoload` just in case. Clean the cache (built containers).

The migration should be complete. Run tests to see if there are any missed places or anything changed which wasn't supped to.
