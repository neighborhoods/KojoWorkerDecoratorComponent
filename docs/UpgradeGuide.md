# Upgrading from 3.* to 4.*

The upgrade guide from 2.* to 3.* can be found [here](https://github.com/neighborhoods/KojoWorkerDecoratorComponent/blob/3.0.0/docs/UpgradeGuide.md).

In version 4 all components have been versioned. The structure is refactored causing changes in namespaces, paths and fabricated method names.

Common (not decorator specific) code has been moved from `src` to `src/WorkerDecorationV1`.

Decorators have been moved from `src/Worker` into their own versioned directory. For example `src/Worker/CrashedThresholdDecorator.php` is now in `src/WorkerDecoratorionV1Decorators/CrashedThresholdV1/CrashedThresholdDecorator.php` along with accompanying files.

To quickly switch to the new file structure run the following regex inside your source and possibly test folders.
```bash
grep -RiIl 'KojoWorkerDecoratorComponent' | xargs sed -i 's/Worker\\([a-zA-Z]*)Decorator/WorkerDecorationV1Decorators\\$1V1\\$1Decorator/g'
grep -RiIl 'KojoWorkerDecoratorComponent' | xargs sed -i 's/KojoWorkerDecoratorComponent\\Worker(?!D)/KojoWorkerDecoratorComponent\\WorkerDecorationV1\\Worker/g'
grep -RiIl 'KojoWorkerDecoratorComponent' | xargs sed -i 's/KojoWorkerDecoratorComponent\\Connection/KojoWorkerDecoratorComponent\\WorkerDecorationV1\\Connection/g'

# fix getters and setters from fabricated aware traits
grep -RiIl 'KojoWorkerDecoratorComponent' | xargs sed -i 's/etWorker([a-zA-Z]*)Decorator/etWorkerDecorationV1Decorators$1V1$1Decorator/g'
grep -RiIl 'KojoWorkerDecoratorComponent' | xargs sed -i 's/etWorker(?!D)/etWorkerDecorationV1Worker/g'
```
Review the changes after running the commands. Having a clean git repository will make it easier.

Buphalo fabricated files.

Run `composer dump-autload` just in case. Clean the cache (built containers).

The migration should be complete. Run tests to see if there are any missed places or anything changed which wasn't supped to.
