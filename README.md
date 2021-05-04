# Kōjō Worker Decorators

A set of useful decorators for a typical [Kōjō](https://github.com/neighborhoods/kojo) Worker.

## Install

Via Composer

``` bash
$ composer require neighborhoods/kojo-worker-decorator-component
```

### Versioning

Don't confuse releases on [packagist](https://packagist.org/packages/neighborhoods/kojo-worker-decorator-component), e.g. 3.0.0, with versions of components contained within this package, e.g. ExceptionHandlingV1. One release may contain multiple versions of the same component.  
Parts of your code may use older versions of components, while others use the latest.

### Upgrade

For upgrading from release 2 to release 3 follow the [Upgrade Guide](docs/UpgradeGuide.md).

## Usage

Components fall into one of two categories
* Worker Decoration
* Worker Decorator

The **Worker Decoration** is about decorating the worker. The Worker Decoration mostly contains interfaces. It determines how the worker looks like, how the decorators look like, how to define the stack of decorators to be used, how to obtain a decorated worker ready for usage.  
There might be multiple versions of worker decoration, e.g. WorkerDecorationV1 and WorkerDecorationV2.

A **Worker Decorator** provides a specific functionality to the decorated worker. Multiple decorators can be used on the same worker.  
A worker decorator is made for a specific version of Worker Decoration. All decorators compatible with WorkerDecorationV1 are placed in the `src/WorkerDecorationV1Decorators` folder.  
There are different functionalities, e.g. exception handling, crash threshold. There is a set of recommended predefined decorators to be used on each worker. Check the specific Worker Decoration version for more details.  
The same functionality may have multiple versions, e.g. ExceptionHandlingV1, ExceptionHandlingV2. Use the latest version if possible.  
You can implement your own decorator.

For usage details and list of predefined decorators please refer to the corresponding Worker Decoration version.
* [WorkerDecorationV1](src/WorkerDecorationV1/README.md)

## Buphalo integration

[Buphalo](https://github.com/neighborhoods/Buphalo) templates are available for workers and custom decorators as well as their accompanying files. Read the specific version documentation for more details.

### Prerequisites

The Buphalo templates are provided in a custom template tree. Support for multiple template trees has been added to Buphalo in version 1.1. Ensure you have Buphalo version 1.1 or above installed.  
You probably have a script in your project's `bin` folder running `vendor/bin/buphalo` with all the needed environment variables. Edit the environment variable for template tree directory paths to include the template tree contained in this package. The environment variable definition might be as below.
``` bash
Neighborhoods_Buphalo_V1_TemplateTree_Map_Builder_FactoryInterface__TemplateTreeDirectoryPaths=default:$PWD/vendor/neighborhoods/buphalo/template-tree/V1,kwdc:$PWD/vendor/neighborhoods/kojo-worker-decorator-component/template-tree/BuphaloV1
```

The export above assumes that you have no other custom template trees.

## Examples

Application examples are available in the [Fitness](https://github.com/neighborhoods/KojoWorkerDecoratorComponentFitness) project.
